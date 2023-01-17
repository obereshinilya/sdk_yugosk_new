<?php

namespace App\Http\Controllers;

use App\Events\AddLogs;

use App\Events\WasBanned;
use App\Events\WasUnbanned;
use App\Models\Logs;
use App\Models\Logs_safety;
use App\Models\Permission;

//use App\Models\Role;
use App\Models\Ref_obj;
use App\Models\XML_journal;
use App\Ref_opo;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use XmlResponse\Facades\XmlFacade;
use function Sodium\compare;

class AdminController extends Controller
{
    // Запись логов
    public static function log_record($message)
    {
        $logs_all = Role::join('model_has_roles', 'id', '=', 'model_has_roles.role_id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->where('model_has_roles.role_id', '=', 2)->orWhere('model_has_roles.role_id', '=', 3)->where('users.name', '=', Auth::user()->name)->get();

        $ip = request()->ip();
        $message_new = "Пользователь" . " " . Auth::user()->name . " " . $message;
        $input['description'] = $message_new;
        $input['username'] = Auth::user()->name;
        $input['ip'] = $ip;
        $input['created_at'] = date('Y-m-d H:i:s', strtotime('+1 hours'));
        $logs = Logs::create($input);
    }

    // Вывод логов
    public function log_view(Request $request)
    {
        AdminController::log_record('Открыл журнал для просмотра  ');//пишем в журнал
        $logs = Logs::orderBydesc('id')->paginate(20);
        $logs_all = Logs::orderByDesc('id')->get();
        foreach ($logs as $key => $log) {
            $date[$key] = date('d.m.Y H:m:s', strtotime($log->created_at));
        }
        $i = count($logs_all);
        $page = $request->page;
        if ($page == null) {
            $page = 1;
        }
        return view('web.admin.admin_main', ['logs' => $logs, 'all_logs' => $logs_all, 'i' => $i, 'page' => $page, 'date' => $date]);
    }


    //проверка заполненности журналов
    public function check_journal_full()
    {
        $js_logs = Logs::orderByDesc('id')->get();
        $setting_journal = Logs_safety::first();
        //проверки на заполненность
        if ((count($js_logs) / $setting_journal->js_max) * 100 > $setting_journal->js_warning) {
            return 4;   //если предупредительный ЖС
        } elseif ((count($js_logs) / $setting_journal->js_max) * 100 > $setting_journal->js_attention) {
            return 3;   //если аварийный ЖС
        }
    }

    //редактирование настроек безопасности
    public function config_edit()
    {
        $config = Logs_safety::first();
        AdminController::log_record('Открыл для просмотра конфигурацию безопасности');
        return view('web.config_safety.edit', compact('config'));
    }

    //обновление настроек
    public function config_update(Request $request)
    {
        $js_warning = $request->js_attention;
        $this->validate($request, [
            'num_znak' => 'required|numeric|min:1',
            'num_error' => 'required|numeric|min:1',
            'time_ban' => 'required|numeric|min:1',
            'num_password' => 'required|numeric|min:1',
            'time_session' => 'required|numeric|min:1',
            'time_password' => 'required|numeric|min:1',
            'js_max' => 'required|numeric|min:1',
            'js_attention' => 'required|numeric|min:1',
            'js_warning' => 'required|numeric|min:' . $js_warning,

        ]);
        $input = $request->all();
        $config = Logs_safety::first();
        $config->update($input);
        AdminController::log_record('Сохранил после изменения конфигурацию безопасности');
        return redirect('/admin');
    }

    // Вывод привелегий
    public function perm_view()
    {
        AdminController::log_record('Открыл для просмотра справочник привелегий');
        return view('web.admin.perm_view', ['perms' => Permission::orderBy('id')->get()]);
    }

    // Выгрузка логов
    public function pdf_logs()
    {
        $data['title'] = 'Журнал событий';
        $data['logs'] = Role::join('model_has_roles', 'id', '=', 'model_has_roles.role_id')
            ->join('users', 'model_has_roles.model_id', '=', 'users.id')
            ->join('logs', 'users.name', '=', 'logs.username')->where('roles.name', '!=', "Администратор ИС")->where('roles.name', '!=', "Администратор ИБ")->
            orderByDesc('logs.id')->get();
        foreach ($data['logs'] as $key => $log) {
            $data['date'][$key] = date('d.m.Y H:m:s', strtotime($log->created_at));
        }
        $data['count'] = count($data['logs']);
        $patch = 'logs' . Carbon::now() . '.pdf';
        $ip = request()->ip();
        event(new AddLogs(Auth::user()->name, $patch, $ip));  //пишем в журнал
        $pdf = PDF::loadView('web.admin.logs_pdf', compact('data'));

        return $pdf->download($patch);
    }


    // Удаление логов
    public function clear_logs()
    {
        Logs::truncate();

        $this->log_record('Очистил журнал событий ИБ');//пишем в журнал

        return redirect('/admin');
    }

    //Блокировка пользователя
    public function ban1_user($id)
    {
        $user = User::find($id);
        $user->ban();
        $this->log_record('Заблокировал пользователя ' . $user->name);//пишем в журнал
        return redirect('/users');
    }

    //Разблокировка пользователя

    public function unban_user($id)
    {
        $user = User::find($id);
        $user->unban();
        $this->log_record('Разблокировал пользователя ' . $user->name);//пишем в журнал
        return redirect('/users');
    }


}
