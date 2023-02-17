<?php

namespace App\Http\Controllers;

use App\Models\Jas;
use App\Models\Main_models\RefObj;
use App\Models\Main_models\RefOpo;
use App\Models\Main_models\RefTb;
use App\Models\Main_models\TypeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class JasController extends Controller
{
    public function save_new_jas(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if ($record_data['repair'] == 'false') {
                $to_table['status'] = TypeStatus::where('id_status', '=', RefTb::where('id_tb', '=', $record_data['id_tb'])->first()->id_status)->first()->descstatus;
            } else {
//            RefTb::where('id_tb', '=', $record_data['id_tb'])->first()->update(['id_status'=>4]);
                $to_table['status'] = 'Регламентные работы';
            }
            $to_table['opo'] = RefOpo::where('id_opo', '=', $record_data['id_opo'])->first()->short_name_opo;
            $to_table['elem_opo'] = RefTb::where('id_tb', '=', $record_data['id_tb'])->first()->full_name_tb;
            $to_table['sobitie'] = $record_data['sobitie'];
            $to_table['comment'] = $record_data['comment'];
            $to_table['author'] = Auth::user()->name;
            $to_table['auto_generate'] = true;
            $to_table['check'] = true;
            Jas::create($to_table);
            if ($record_data['repair'] != 'false') {
                RefTb::where('id_tb', '=', $record_data['id_tb'])->first()->update(['id_status' => 4]);
            }
            AdminController::log_record('Добавил запись в журнал аварийных событий  ');//пишем в журнал
        } catch (\Throwable $exception) {
            return $exception;
        }

    }

    public function save_comment($id_record, $text)
    {
        Jas::where('id', '=', $id_record)->first()->update(['comment' => $text, 'author' => Auth::user()->name]);
    }

    public function get_tb_for_jas($type_tb, $id_obj)
    {
        return RefTb::where('type_tb', '=', $type_tb)->where('id_obj', '=', $id_obj)->orderby('short_name_tb')->get();
    }

    public function jas_new_record()
    {
        return view('web.jas.create');
    }

    public function showJas()
    {
//        $data_to_jas = \App\Models\Jas::orderbydesc('id')->where('auto_generate', '=', true)->get();
        AdminController::log_record('Открыл журнал аварийных событий  ');//пишем в журнал
//        foreach ($data_to_jas as $key => $jas) {
//            $date[$key] = date('d.m.Y H:m:s', strtotime($jas->date));
//        }
        return view('web.jas.index');
    }

    public function jas_in_top_table()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->take(20)->get();
        return $data_to_jas;
    }

    public function check_new_JAS()
    {
        $data_to_jas = \App\Models\Jas::orderbyDesc('id')->where('auto_generate', '=', true)->where('check', '=', false)->get();
        if (count($data_to_jas) != 0) {
            return $data_to_jas;
        } else {
            return false;
        }
    }

    public function jas_commit($id)
    {
        try {
            $check_sobitie = \App\Models\Jas::find($id)->update(['check' => true]);
            $date = date('Y-m-d H:i:s', strtotime(\App\Models\Jas::find($id)->first()->date));
            AdminController::log_record("Квитировал событие от $date ");//пишем в журнал
            return true;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function get_jas_date($start, $end)
    {
        $data = Jas::where('date', '>=', date('Y-m-d 00:01', strtotime($start)))->where('date', '<=', date('Y-m-d 23:59', strtotime($end)))->orderbydesc('id')->where('auto_generate', '=', true)->get();
        return $data;
    }

    public function get_tb($name)
    {
        $id = RefTb::where('full_name_tb', $name)->value('id_tb');
        if (RefObj::where('id_obj', (int)RefTb::where('full_name_tb', $name)->value('id_obj'))->value('id_opo') == 2) {
            $ks = RefObj::where('id_obj', (int)RefTb::where('full_name_tb', $name)->value('id_obj'))->value('short_name_obj');
            return [2, $ks, $id];
        }
        return $id;

    }

}
