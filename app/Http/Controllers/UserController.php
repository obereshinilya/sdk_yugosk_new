<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Models\Logs_safety;
use App\Models\Password_history;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        AdminController::log_record('Открыл справочник пользователей');
        $user = User::orderBy('id', 'DESC')->paginate(12);
        $all_user = User::orderByDesc('id')->get();
        $i = count($all_user);
        $page = $request->page;
        if ($page == null) {
            $page = 1;
        }
        return view('users.index', ['users' => $user, 'all_user' => $all_user, 'i' => $i, 'page' => $page]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $password_config = Logs_safety::first();
        return view('users.create', compact('roles', 'password_config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time_stop_session = $request->time_stop;
        $password_config = Logs_safety::first();
        if ($password_config->up_register == 1)
            $format_up = '(?=.*[a-z])(?=.*[A-Z])';
        else
            $format_up = '(?=.*[a-z])';
        if ($password_config->num_check == 1)
            $format_num = '(?=.*[0-9])';
        else
            $format_num = '(?=.*[0-9]*)';
        if ($password_config->spec_check == 1)
            $format_spec = '(?=.*[!%?@,.<>#№^:])';
        else
            $format_spec = '(?=.*[!%?@,.<>#№^:]*)';

        $this->validate($request, [
            'name' => 'required|unique:users,name|regex:/^(?-i)[a-zA-Z0-9]+$/i',
            'email' => 'required|email|unique:users,email|regex:/^(?-i)[a-z0-9@.]+$/i',
            'password' => 'required|same:confirm-password|string|min:' . $password_config->num_znak . '|regex:/^(?-i)' . $format_up . $format_num . $format_spec . '+/i',
            'roles' => 'required',
            'surname' => 'required|alpha|regex:/^(?-i)[а-яА-Я]/i',
            'middle_name' => 'required|alpha|regex:/^(?-i)[а-яА-Я]/i',
            'imya' => 'required|alpha|regex:/^(?-i)[а-я]/i',
            'time_begin' => 'before:' . $time_stop_session,
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['date_new_password'] = date('Y-m-d');

        $user = User::create($input);
        $user->assignRole($request->input('roles'));
        if (!empty($user->getRoleNames()))
            foreach ($user->getRoleNames() as $v)
                AdminController::log_record('Добавил пользователя ' . $user->name . ' и назначил роль ' . $v);
        else
            AdminController::log_record('Добавил пользователя ' . $user->name . ' и неназначил роль ');
        app()['cache']->forget('spatie.permission.cache');
        return redirect()->route('users.index')
            ->with('success', 'Новый пользователь успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        AdminController::log_record('Открыл данные пользователя ' . $user->name . ' для просмотра ');
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $password_config = Logs_safety::first();
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $text = 1;
        return view('users.edit', compact('user', 'roles', 'userRole', 'password_config', 'text'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->password_confirm == null) {   //если пароль не меняли
            $user = User::find($id);
            $input = $request->all();
            unset($input['password']);
            unset($input['confirm-password']);
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));
            if (!empty($user->getRoleNames()))
                foreach ($user->getRoleNames() as $v)
                    AdminController::log_record('Изменил данные пользователя ' . $user->name . ' и назначил роль ' . $v);
            else
                AdminController::log_record('Изменил данные пользователя ' . $user->name . ' и не назначил роль ');
            return redirect()->route('users.index')
                ->with('success', 'Данные пользователя обновлены');

        } else {    //если пароль сменили
            $time_stop_session = $request->time_stop;
            $password_config = Logs_safety::first();
            if ($password_config->up_register == 1)
                $format_up = '(?=.*[a-z])(?=.*[A-Z])';
            else
                $format_up = '(?=.*[a-z])';
            if ($password_config->num_check == 1)
                $format_num = '(?=.*[0-9])';
            else
                $format_num = '(?=.*[0-9]*)';
            if ($password_config->spec_check == 1)
                $format_spec = '(?=.*[!%?@,.<>#№^:])';
            else
                $format_spec = '(?=.*[!%?@,.<>#№^:]*)';

            $this->validate($request, [
                'email' => 'required|email|unique:users,email,' . $id,
                'name' => 'required|regex:/^(?-i)[a-zA-Z0-9]+$/i',
                'password' => 'required|same:confirm-password|string|min:' . $password_config->num_znak . '|regex:/^(?-i)' . $format_up . $format_num . $format_spec . '+/i',
                'roles' => 'required',
                'surname' => 'required|alpha|regex:/^(?-i)[а-яА-Я]/i',
                'middle_name' => 'required|alpha|regex:/^(?-i)[а-яА-Я]/i',
                'imya' => 'required|alpha|regex:/^(?-i)[а-я]/i',
                'time_begin' => 'before:' . $time_stop_session,
            ]);
            $input = $request->all();

            $history_pass = Password_history::where('id_user', '=', $id)->orderByDesc('id_pass')->take($password_config->num_password)->get(); //вывели последние пароли в количестве указанном в конфигурации безопасности

            foreach ($history_pass as $history) {                //проходимся по паролям
                if (Hash::check($input['password'], $history->password)) {   //если есть совпадения, то ставим в таблицу отметку "не подходит"
                    return redirect()->route('users.edit', $id)->with('success', 'Введенный пароль был использован ранее. Введите уникальный пароль');
                }
            }
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
                $data_pass['id_user'] = $id;
                $data_pass['password'] = $input['password'];
                $pass = Password_history::create($data_pass);
            } else {
                $input = Arr::except($input, array('password'));
            }

            $user = User::find($id);
            $input['date_new_password'] = date('Y-m-d');
            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();

            $user->assignRole($request->input('roles'));
            if (!empty($user->getRoleNames()))
                foreach ($user->getRoleNames() as $v)
                    AdminController::log_record('Изменил данные пользователя (включая пароль) ' . $user->name . ' и назначил роль ' . $v);
            else
                AdminController::log_record('Изменил данные пользователя (включая пароль) ' . $user->name . ' и не назначил роль ');
            app()['cache']->forget('spatie.permission.cache');
            return redirect()->route('users.index')
                ->with('success', 'Данные пользователя обновлены');
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        AdminController::log_record('Удалил пользователя ' . $user->name);
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'Пользователь удален');
    }

}
