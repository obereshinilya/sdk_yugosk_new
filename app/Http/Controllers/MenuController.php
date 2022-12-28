<?php

namespace App\Http\Controllers;

use App\Models\Calc_mku_pipe_cond;
use App\Models\Main_models\RefDO;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MenuController extends Controller
{
   public function view_menu ()
   {
    $status_do = RefDO::where('id_do', '=', 1)->first()->id_status;
    $class = array(1=>'critical',
        2=>'bad',
        3=>'good',
        4=>'repair',
        5=>'corrupt',);
    $text = array(1=>'Предельное состояние',
        2=>'Работоспособное состояние',
        3=>'Исправное состояние',
        4=>'Ремонтные работы',
        5=>'Нет данных',);
   AdminController::log_record('Открыл ситуационную карту');//пишем в журнал
   return view('web.gda', ['class' => $class[$status_do], 'text'=>$text[$status_do]]);
   }
}
