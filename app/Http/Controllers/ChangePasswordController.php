<?php

namespace App\Http\Controllers;

use App\Models\Logs_safety;
use App\Models\Password_history;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Controllers\AdminController;

class ChangePasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $password_config = Logs_safety::first();
        $error = '';
        return view('auth.changePassword',compact( 'password_config', 'error'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $password_config = Logs_safety::first();
        if($password_config->up_register == 1)
            $format_up = '(?=.*[a-z])(?=.*[A-Z])';
        else
            $format_up = '(?=.*[a-z])';
        if($password_config->num_check == 1)
            $format_num = '(?=.*[0-9])';
        else
            $format_num = '(?=.*[0-9]*)';
        if($password_config->spec_check == 1)
            $format_spec = '(?=.*[!%?@,.<>#№^:])';
        else
            $format_spec = '(?=.*[!%?@,.<>#№^:]*)';

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => 'required|string|min:'.$password_config->num_znak.'|regex:/^(?-i)'.$format_up.$format_num.$format_spec.'+/i',
            'new_confirm_password' => ['same:new_password'],
        ]);
        $id = Auth::user()->id;
        $history_pass = Password_history::where('id_user', '=', $id)->orderByDesc('id_pass')->take($password_config->num_password)->get(); //вывели последние пароли в количестве указанном в конфигурации безопасности
//dd($request->new_password);
        foreach ($history_pass as $history){                //проходимся по паролям
            if (Hash::check($request->new_password, $history->password)){   //если есть совпадения, то ставим в таблицу отметку "не подходит"
                $password_config = Logs_safety::first();
                $error = 'Введенный пароль был использован ранее. Введите уникальный пароль';
                return view('auth.changePassword', compact('password_config', 'error'));
            }
        }
        $data_pass['id_user'] = $id;
        $data_pass['password'] = Hash::make($request->new_password);
        $pass = Password_history::create($data_pass);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        AdminController::log_record('Изменил пароль ');//пишем в журнал

        return redirect('/');

    }
}
