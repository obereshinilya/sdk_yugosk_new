<?php

namespace App\Http\Controllers;

use App\Models\Main_models\AVO;
use App\Models\Main_models\BPTPG;
use App\Models\Main_models\CleaningGas;
use App\Models\Main_models\GPA;
use App\Models\Main_models\InputShleif;
use App\Models\Main_models\KRANS;
use App\Models\Main_models\KRANS_KC;
//use App\Models\Main_models\LineRecirk;
use App\Models\Main_models\MKU;
use App\Models\Main_models\OutputShleif;
use App\Models\Main_models\RefDO;
use App\Models\Main_models\RefObj;
use App\Models\Main_models\RefOpo;
use App\Models\Main_models\RefTb;
use App\Models\Main_models\TagTable;
use App\Models\Main_models\TechObv;
use App\Models\Main_models\TypeTb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DirectoryController extends Controller
{
    public function show_directory_do()
    {
        $opos = DB::table('public.ref_do')->
        join('public.typestatus', 'public.ref_do.id_status', '=', 'public.typestatus.id_status')
            ->orderby('short_name_do')->get();
        AdminController::log_record('Открыл справочник филиалов ДО ');//пишем в журнал
        return view('web.docs.infoDO.index', compact('opos'));
    }

    public function create_do()
    {
        return view('web.docs.infoDO.create');
    }

    public function save_do(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['id_status'] = 3;
            RefDO::create($record_data);
            AdminController::log_record('Добавил запись в справочник филиалов ДО');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function edit_do($id_do)
    {
        $data = RefDO::where('id_do', '=', $id_do)->first();

        return view('web.docs.infoDO.edit', compact('data'));
    }

    public function update_do(Request $request, $id_do)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            RefDO::where('id_do', '=', $id_do)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id_do . ' ДО ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_do($id_do)
    {
        $data = RefDO::where('id_do', '=', $id_do)->first();

        return view('web.docs.infoDO.show', compact('data'));
    }

    public function show_directory_opo()
    {
        $opos = DB::table('public.ref_opo')->
        join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
        join('public.typestatus', 'public.ref_opo.id_status', '=', 'public.typestatus.id_status')
            ->orderby('id_opo')->get();
        AdminController::log_record('Открыл справочник ОПО ');//пишем в журнал
        return view('web.docs.infoOPO.index', compact('opos'));
    }

    public function show_directory_obj()
    {
        $objects = DB::table('public.ref_obj')->
        join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
        join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
        join('public.typestatus', 'public.ref_obj.id_status', '=', 'public.typestatus.id_status')
            ->orderby('short_name_do', 'ASC')->orderby('full_name_opo', 'ASC')->orderby('full_name_obj', 'ASC')->get();
        AdminController::log_record('Открыл справочник элементов ОПО  ');//пишем в журнал
        return view('web.docs.infoObj.index', compact('objects'));
    }

    public function show_directory_tb()
    {
        $tb = DB::table('public.ref_tb')->
        join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
        join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
        join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
        join('public.typestatus', 'public.ref_tb.id_status', '=', 'public.typestatus.id_status')->
        join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
        orderby('id_tb')->get();
        AdminController::log_record('Открыл справочник ТБ элементов ОПО  ');//пишем в журнал
        return view('web.docs.infoTB.index', compact('tb'));
    }


//    Блок создания и редактирования ОПО
    public function create_opo()
    {
        return view('web.docs.infoOPO.create');
    }

    public function save_opo(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['id_status'] = 3;
            RefOpo::create($record_data);
            AdminController::log_record('Добавил запись в справочник ОПО');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function edit_opo($id_opo)
    {
        $data = RefOpo::where('id_opo', '=', $id_opo)->first();

        return view('web.docs.infoOPO.edit', compact('data'));
    }

    public function update_opo(Request $request, $id_opo)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            RefOpo::where('id_opo', '=', $id_opo)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id_opo . ' ОПО ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_opo($id_opo)
    {
        $data = RefOpo::where('id_opo', '=', $id_opo)->first();

        return view('web.docs.infoOPO.show', compact('data'));
    }


//    Создание и редактирование элементов
    public function create_obj()
    {
        return view('web.docs.infoObj.create');
    }

    public function get_do($id_do)
    {
        return RefOpo::where('id_do', '=', $id_do)->orderby('full_name_opo')->get()->toArray();
    }

    public function save_obj(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['id_status'] = 3;
            RefObj::create($record_data);
            AdminController::log_record('Добавил запись в справочник элементов ОПО');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function edit_obj($id_obj)
    {
        $data = RefObj::where('id_obj', '=', $id_obj)->first();

        return view('web.docs.infoObj.edit', compact('data'));
    }

    public function update_obj(Request $request, $id_obj)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            RefObj::where('id_obj', '=', $id_obj)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id_obj . ' элемент ОПО ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }


    //Создание и редактирование ТБ
    public function edit_directory_tb($id_tb)
    {
        $type = RefTb::where('id_tb', '=', $id_tb)->first()->type_tb;
        if ($type == 1) { //если трубопровод
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.mku', 'public.ref_tb.id_tb', '=', 'public.mku.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'mku.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_mku', compact('data_tb'));
        } elseif ($type == 2) {//если кран
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.krans', 'public.ref_tb.id_tb', '=', 'public.krans.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'krans.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_kran', compact('data_tb'));
        } elseif ($type === 3) {//если ГПА
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.gpa', 'public.ref_tb.id_tb', '=', 'public.gpa.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'gpa.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_gpa', compact('data_tb'));
        } elseif ($type === 4) {//если тех обвязка
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.tech_obv', 'public.ref_tb.id_tb', '=', 'public.tech_obv.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'tech_obv.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_tech_obv', compact('data_tb'));
        } elseif ($type === 5) {//если линия рециркуляции
//            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
//            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
//            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
//            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
//            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
//            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
//            join('public.line_recirc', 'public.ref_tb.id_tb', '=', 'public.line_recirc.id_tb')->
//            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'line_recirc.*', 'buffer_table_mku_tags.*')->
//            get()->first();
//            return view('web.docs.infoTB.edit_line_recirk', compact('data_tb'));
        } elseif ($type === 6) {//если вх шлейф
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.input_shleif', 'public.ref_tb.id_tb', '=', 'public.input_shleif.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'input_shleif.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_input_shleif', compact('data_tb'));
        } elseif ($type === 7) {//если вых шлейф
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.output_shleif', 'public.ref_tb.id_tb', '=', 'public.output_shleif.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'output_shleif.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_output_shleif', compact('data_tb'));
        } elseif ($type === 8) {//УОГ
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.cleaning_gas', 'public.ref_tb.id_tb', '=', 'public.cleaning_gas.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'cleaning_gas.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_cleaning_gas', compact('data_tb'));
        } elseif ($type === 9 || $type === 10) {//БПТПГ или УПТИГ
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.bptpg', 'public.ref_tb.id_tb', '=', 'public.bptpg.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'bptpg.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_bptpg', compact('data_tb'));
        } elseif ($type === 11) {//АВО
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.avo', 'public.ref_tb.id_tb', '=', 'public.avo.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'avo.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_avo', compact('data_tb'));
        } elseif ($type === 12) {//Краны КЦ
            $data_tb = DB::table('public.ref_tb')->where('public.ref_tb.id_tb', '=', $id_tb)->
            join('public.typetb', 'public.ref_tb.type_tb', '=', 'public.typetb.type_tb')->
            join('public.buffer_table_mku_tags', 'public.ref_tb.id_tb', '=', 'public.buffer_table_mku_tags.id_tb')->
            join('public.ref_obj', 'public.ref_tb.id_obj', '=', 'public.ref_obj.id_obj')->
            join('public.ref_opo', 'public.ref_obj.id_opo', '=', 'public.ref_opo.id_opo')->
            join('public.ref_do', 'public.ref_opo.id_do', '=', 'public.ref_do.id_do')->
            join('public.krans_kc', 'public.ref_tb.id_tb', '=', 'public.krans_kc.id_tb')->
            select('ref_tb.*', 'typetb.*', 'ref_obj.full_name_obj', 'ref_opo.full_name_opo', 'ref_do.full_name_do', 'krans_kc.*', 'buffer_table_mku_tags.*')->
            get()->first();
            return view('web.docs.infoTB.edit_kran_kc', compact('data_tb'));
        }
    }

    public function update_tb($type_tb, $id_tb, Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            if ($type_tb != 2 && $type_tb != 12) {
                if ($record_data['id_status']) {
                    $to_ref_tb['id_status'] = $record_data['id_status'];
                } else {
                    if (RefTb::where('id_tb', '=', $id_tb)->first()->id_status == 4) {
                        $to_ref_tb['id_status'] = 3;
                    }
                }
                unset($record_data['id_status']);
            }

            if ($type_tb == 1) {    //если межкрановый участок
                //    if ($record_data['id_status']){
                //      $to_ref_tb['id_status'] = $record_data['id_status'];
                //  }else{
                //     $to_ref_tb['id_status'] =3;
                // }
                unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                MKU::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 2) {   //если крановый узел
//                if ($record_data['id_status']){
//                    $to_ref_tb['id_status'] = $record_data['id_status'];
//                }else{
//                    $to_ref_tb['id_status'] =3;
//                }
//                unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['status_kran'] = $record_data['status_kran'];
                unset($record_data['status_kran']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                KRANS::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 3) {  //ГПА
//                if ($record_data['id_status']){
                //                  $to_ref_tb['id_status'] = $record_data['id_status'];
                //            }else{
                //              $to_ref_tb['id_status'] =3;
                //        }
                //      unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['status_kran'] = $record_data['status_kran'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                unset($record_data['status_kran']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                GPA::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 4) {  //тех обвязка
                //               if ($record_data['id_status']){
                //                 $to_ref_tb['id_status'] = $record_data['id_status'];
                //           }else{
                //             $to_ref_tb['id_status'] =3;
                //       }
                //     unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                TechObv::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 5) {  //лин рециркуляции
                //               if ($record_data['id_status']){
                //                 $to_ref_tb['id_status'] = $record_data['id_status'];
                //           }else{
                //             $to_ref_tb['id_status'] =3;
                //       }
                //     unset($record_data['id_status']);
//                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
//                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
//                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
//                unset($record_data['full_name_tb']);
//                unset($record_data['short_name_tb']);
//                unset($record_data['guid_tb']);
//                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
//                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
//                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
//                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
//                unset($record_data['tag_p_in']);
//                unset($record_data['tag_p_out']);
//                unset($record_data['tag_t_in']);
//                unset($record_data['tag_t_out']);
//                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);
//
//                LineRecirk::where('id_tb', '=', $id_tb)->first()->update($record_data);
//                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

//                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 6) {  //вх шлейф
//                if ($record_data['id_status']){
                //                  $to_ref_tb['id_status'] = $record_data['id_status'];
                //            }else{
                //              $to_ref_tb['id_status'] =3;
                //        }
                //      unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                unset($record_data['tag_p_in']);
                unset($record_data['tag_t_in']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);
                InputShleif::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 7) {  //вых шлейф
                //               if ($record_data['id_status']){
                //                 $to_ref_tb['id_status'] = $record_data['id_status'];
                //           }else{
                //             $to_ref_tb['id_status'] =3;
                //       }
                //     unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                unset($record_data['tag_p_out']);
                unset($record_data['tag_t_out']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);
                OutputShleif::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 8) {  //УОГ
//                if ($record_data['id_status']){
                //                  $to_ref_tb['id_status'] = $record_data['id_status'];
                //            }else{
                //              $to_ref_tb['id_status'] =3;
                //        }
                //      unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                unset($record_data['tag_p_out']);
                unset($record_data['tag_p_in']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                CleaningGas::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 9 || $type_tb == 10) {  //УОГ
//                if ($record_data['id_status']){
                //                  $to_ref_tb['id_status'] = $record_data['id_status'];
                //            }else{
                //              $to_ref_tb['id_status'] =3;
                //        }
                //      unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                unset($record_data['tag_t_out']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_p_out']);
                unset($record_data['tag_p_in']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                CleaningGas::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 11) {  //АВО
                //             if ($record_data['id_status']){
                //               $to_ref_tb['id_status'] = $record_data['id_status'];
                //         }else{
                //           $to_ref_tb['id_status'] =3;
                //     }
                //   unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                unset($record_data['tag_t_out']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_p_out']);
                unset($record_data['tag_p_in']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

                AVO::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 12) {   //если крановый узел кц
//                if ($record_data['id_status']){
//                    $to_ref_tb['id_status'] = $record_data['id_status'];
//                }else{
//                    $to_ref_tb['id_status'] =3;
//                }
//                unset($record_data['id_status']);
                $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
                $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
                $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
                unset($record_data['full_name_tb']);
                unset($record_data['short_name_tb']);
                unset($record_data['guid_tb']);
//                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
//                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['status_kran'] = $record_data['status_kran'];
                unset($record_data['status_kran']);
//                unset($record_data['tag_p_in']);
//                unset($record_data['tag_p_out']);
                RefTb::where('id_tb', '=', $id_tb)->first()->update($to_ref_tb);

//                KRANS_KC::where('id_tb', '=', $id_tb)->first()->update($record_data);
                TagTable::where('id_tb', '=', $id_tb)->first()->update($to_tag_name);

                AdminController::log_record('Изменил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function create_tb()
    {
        return view('web.docs.infoTB.create');
    }

    public function get_obj($id_opo)
    {
        return RefObj::where('id_opo', '=', $id_opo)->orderby('full_name_obj')->get()->toArray();
    }

    public function get_typetb($id_obj)
    {
        $type_obj = RefObj::where('id_obj', '=', $id_obj)->first()->type_obj;
        return TypeTb::where('from_type_obj', '=', $type_obj)->orderby('full_name_type')->get()->toArray();
    }

    public function get_tb($type_tb)
    {
        $data_to_table[0]['text'] = 'Краткое наименование ТБ';
        $data_to_table[0]['id'] = 'short_name_tb';
        $data_to_table[0]['type'] = 'text';
        $data_to_table[1]['text'] = 'Полное наименование ТБ';
        $data_to_table[1]['id'] = 'full_name_tb';
        $data_to_table[1]['type'] = 'text';
        $data_to_table[2]['text'] = 'Идентификатор ТБ';
        $data_to_table[2]['id'] = 'guid_tb';
        $data_to_table[2]['type'] = 'text';
        if ($type_tb == 1) {    //если межкрановый участок
            $data_to_table[3]['text'] = 'Начало участка, км';
            $data_to_table[3]['id'] = 'l_in';
            $data_to_table[3]['type'] = 'number';
            $data_to_table[4]['text'] = 'Конец участка, км';
            $data_to_table[4]['id'] = 'l_out';
            $data_to_table[4]['type'] = 'number';
            $data_to_table[5]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[5]['id'] = 'p_project';
            $data_to_table[5]['type'] = 'number';
            $data_to_table[6]['text'] = 'Расчетное давление по классу безопасности "Низкий", кгс/см2';
            $data_to_table[6]['id'] = 'p_low';
            $data_to_table[6]['type'] = 'number';
            $data_to_table[7]['text'] = 'Расчетная дата перехода участка в класс безопасности "Низкий"';
            $data_to_table[7]['id'] = 'time_low';
            $data_to_table[7]['type'] = 'date';
            $data_to_table[8]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[8]['id'] = 'date_end';
            $data_to_table[8]['type'] = 'date';
            $data_to_table[9]['text'] = 'Давление на входе МКУ (тег)';
            $data_to_table[9]['id'] = 'tag_p_in';
            $data_to_table[9]['type'] = 'text';
            $data_to_table[10]['text'] = 'Давление на выходе МКУ (тег)';
            $data_to_table[10]['id'] = 'tag_p_out';
            $data_to_table[10]['type'] = 'text';
            $data_to_table[11]['text'] = 'Температура на входе МКУ (тег)';
            $data_to_table[11]['id'] = 'tag_t_in';
            $data_to_table[11]['type'] = 'text';
            $data_to_table[12]['text'] = 'Температура на выходе МКУ (тег)';
            $data_to_table[12]['id'] = 'tag_t_out';
            $data_to_table[12]['type'] = 'text';
        } elseif ($type_tb == 2) { //если крановый узел
            $data_to_table[3]['text'] = 'Расположение крана, км';
            $data_to_table[3]['id'] = 'l_kran';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Максимальный перепад давления на кране кгс/см2';
//            $data_to_table[4]['id'] = 'delta_p_max';
//            $data_to_table[4]['type'] = 'number';
//            $data_to_table[5]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[5]['id'] = 'time_low';
//            $data_to_table[5]['type'] = 'date';
//            $data_to_table[6]['text'] = 'Дата окончания действия экспертизы ПБ';
//            $data_to_table[6]['id'] = 'date_end';
//            $data_to_table[6]['type'] = 'date';
            $data_to_table[4]['text'] = 'Давление на входе МКУ (тег)';
            $data_to_table[4]['id'] = 'tag_p_in';
            $data_to_table[4]['type'] = 'text';
            $data_to_table[5]['text'] = 'Давление на выходе МКУ (тег)';
            $data_to_table[5]['id'] = 'tag_p_out';
            $data_to_table[5]['type'] = 'text';
            $data_to_table[6]['text'] = 'Состояние крана (тег)';
            $data_to_table[6]['id'] = 'status_kran';
            $data_to_table[6]['type'] = 'text';
        } elseif ($type_tb == 3) { //если ГПА
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[4]['id'] = 'date_end';
            $data_to_table[4]['type'] = 'date';
            $data_to_table[5]['text'] = 'Коэффициент технического состояния по мощности (тег)';
            $data_to_table[5]['id'] = 'status_kran';
            $data_to_table[5]['type'] = 'text';
            $data_to_table[6]['text'] = 'Давление на входе (тег)';
            $data_to_table[6]['id'] = 'tag_p_in';
            $data_to_table[6]['type'] = 'text';
            $data_to_table[7]['text'] = 'Давление на выходе (тег)';
            $data_to_table[7]['id'] = 'tag_p_out';
            $data_to_table[7]['type'] = 'text';
            $data_to_table[8]['text'] = 'Температура на входе (тег)';
            $data_to_table[8]['id'] = 'tag_t_in';
            $data_to_table[8]['type'] = 'text';
            $data_to_table[9]['text'] = 'Температура на выходе (тег)';
            $data_to_table[9]['id'] = 'tag_t_out';
            $data_to_table[9]['type'] = 'text';
        } elseif ($type_tb == 4) { //если тех обвязка
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[4]['id'] = 'date_end';
            $data_to_table[4]['type'] = 'date';
            $data_to_table[5]['text'] = 'Давление после пылеуловителей (тег)';
            $data_to_table[5]['id'] = 'tag_p_in';
            $data_to_table[5]['type'] = 'text';
            $data_to_table[6]['text'] = 'Давление перед АВО (тег)';
            $data_to_table[6]['id'] = 'tag_p_out';
            $data_to_table[6]['type'] = 'text';
            $data_to_table[7]['text'] = 'Температура после пылеуловителей (тег)';
            $data_to_table[7]['id'] = 'tag_t_in';
            $data_to_table[7]['type'] = 'text';
            $data_to_table[8]['text'] = 'Температура перед АВО (тег)';
            $data_to_table[8]['id'] = 'tag_t_out';
            $data_to_table[8]['type'] = 'text';
            $data_to_table[9]['text'] = 'Общее количество допустимых дефектов';
            $data_to_table[9]['id'] = 'n';
            $data_to_table[9]['type'] = 'number';
            $data_to_table[10]['text'] = 'Общее количество дефектов в работоспособном состоянии';
            $data_to_table[10]['id'] = 'n_w';
            $data_to_table[10]['type'] = 'number';
            $data_to_table[11]['text'] = 'Общее количество дефектов в предельном состоянии';
            $data_to_table[11]['id'] = 'n_lim';
            $data_to_table[11]['type'] = 'number';
        } elseif ($type_tb == 5) { //если линия рециркуляции
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Общее количество допустимых дефектов';
            $data_to_table[4]['id'] = 'n';
            $data_to_table[4]['type'] = 'number';
            $data_to_table[5]['text'] = 'Общее количество дефектов в работоспособном состоянии';
            $data_to_table[5]['id'] = 'n_w';
            $data_to_table[5]['type'] = 'number';
            $data_to_table[6]['text'] = 'Ообщее количество дефектов в предельном состоянии';
            $data_to_table[6]['id'] = 'n_lim';
            $data_to_table[6]['type'] = 'number';
            $data_to_table[7]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[7]['id'] = 'date_end';
            $data_to_table[7]['type'] = 'date';
            $data_to_table[8]['text'] = 'Давление после крана №7 (тег)';
            $data_to_table[8]['id'] = 'tag_p_in';
            $data_to_table[8]['type'] = 'text';
            $data_to_table[9]['text'] = 'Давление перед краном №8 (тег)';
            $data_to_table[9]['id'] = 'tag_p_out';
            $data_to_table[9]['type'] = 'text';
            $data_to_table[10]['text'] = 'Температура после крана №7 (тег)';
            $data_to_table[10]['id'] = 'tag_t_in';
            $data_to_table[10]['type'] = 'text';
            $data_to_table[11]['text'] = 'Температура перед краном №8 (тег)';
            $data_to_table[11]['id'] = 'tag_t_out';
            $data_to_table[11]['type'] = 'text';
        } elseif ($type_tb == 6) { //если входной шлейф
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Общее количество допустимых дефектов';
            $data_to_table[4]['id'] = 'n';
            $data_to_table[4]['type'] = 'number';
            $data_to_table[5]['text'] = 'Общее количество дефектов в работоспособном состоянии';
            $data_to_table[5]['id'] = 'n_w';
            $data_to_table[5]['type'] = 'number';
            $data_to_table[6]['text'] = 'Ообщее количество дефектов в предельном состоянии';
            $data_to_table[6]['id'] = 'n_lim';
            $data_to_table[7]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[7]['id'] = 'date_end';
            $data_to_table[7]['type'] = 'date';
            $data_to_table[8]['text'] = 'Давление после крана №7 (тег)';
            $data_to_table[8]['id'] = 'tag_p_in';
            $data_to_table[8]['type'] = 'text';
            $data_to_table[9]['text'] = 'Температура после крана №9 (тег)';
            $data_to_table[9]['id'] = 'tag_t_in';
            $data_to_table[9]['type'] = 'text';
        } elseif ($type_tb == 7) { //если выходной шлейф
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Общее количество допустимых дефектов';
            $data_to_table[4]['id'] = 'n';
            $data_to_table[4]['type'] = 'number';
            $data_to_table[5]['text'] = 'Общее количество дефектов в работоспособном состоянии';
            $data_to_table[5]['id'] = 'n_w';
            $data_to_table[5]['type'] = 'number';
            $data_to_table[6]['text'] = 'Ообщее количество дефектов в предельном состоянии';
            $data_to_table[6]['id'] = 'n_lim';
            $data_to_table[7]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[7]['id'] = 'date_end';
            $data_to_table[7]['type'] = 'date';
            $data_to_table[8]['text'] = 'Давление перед краном №8 (тег)';
            $data_to_table[8]['id'] = 'tag_p_out';
            $data_to_table[8]['type'] = 'text';
            $data_to_table[9]['text'] = 'Температура перед краном №8 (тег)';
            $data_to_table[9]['id'] = 'tag_t_out';
            $data_to_table[9]['type'] = 'text';
        } elseif ($type_tb == 8) { //если УОГ
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[4]['id'] = 'date_end';
            $data_to_table[4]['type'] = 'date';
            $data_to_table[5]['text'] = 'Давление на входе УОГ (тег)';
            $data_to_table[5]['id'] = 'tag_p_in';
            $data_to_table[5]['type'] = 'text';
            $data_to_table[6]['text'] = 'Давление на выходе УОГ (тег)';
            $data_to_table[6]['id'] = 'tag_p_out';
            $data_to_table[6]['type'] = 'text';
        } elseif ($type_tb == 9 || $type_tb == 10) { //если БПТПГ
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[4]['id'] = 'date_end';
            $data_to_table[4]['type'] = 'date';
            $data_to_table[5]['text'] = 'Давление газа на входе (тег)';
            $data_to_table[5]['id'] = 'tag_p_in';
            $data_to_table[5]['type'] = 'text';
            $data_to_table[6]['text'] = 'Давление пускового газа (тег)';
            $data_to_table[6]['id'] = 'tag_p_out';
            $data_to_table[6]['type'] = 'text';
            $data_to_table[7]['text'] = 'Давление топливного газа (тег)';
            $data_to_table[7]['id'] = 'tag_t_in';
            $data_to_table[7]['type'] = 'text';
            $data_to_table[8]['text'] = 'Давление импульсного газа (тег)';
            $data_to_table[8]['id'] = 'tag_t_out';
            $data_to_table[8]['type'] = 'text';
        } elseif ($type_tb == 11) { //если АВО
            $data_to_table[3]['text'] = 'Разрешенное рабочее давление (кгс/см2)';
            $data_to_table[3]['id'] = 'p_w';
            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[4]['id'] = 'time_low';
//            $data_to_table[4]['type'] = 'date';
            $data_to_table[4]['text'] = 'Дата окончания действия экспертизы ПБ';
            $data_to_table[4]['id'] = 'date_end';
            $data_to_table[4]['type'] = 'date';
            $data_to_table[5]['text'] = 'Давление на входе АВО (тег)';
            $data_to_table[5]['id'] = 'tag_p_in';
            $data_to_table[5]['type'] = 'text';
            $data_to_table[6]['text'] = 'Давление на выходе АВО (тег)';
            $data_to_table[6]['id'] = 'tag_p_out';
            $data_to_table[6]['type'] = 'text';
            $data_to_table[7]['text'] = 'Температура на входе АВО (тег)';
            $data_to_table[7]['id'] = 'tag_t_in';
            $data_to_table[7]['type'] = 'text';
            $data_to_table[8]['text'] = 'Температура на выходе (тег)';
            $data_to_table[8]['id'] = 'tag_t_out';
            $data_to_table[8]['type'] = 'text';
        } elseif ($type_tb == 12) { //если крановый узел КЦ
//            $data_to_table[3]['text'] = 'Расположение крана, км';
//            $data_to_table[3]['id'] = 'l_kran';
//            $data_to_table[3]['type'] = 'number';
//            $data_to_table[4]['text'] = 'Максимальный перепад давления на кране кгс/см2';
//            $data_to_table[4]['id'] = 'delta_p_max';
//            $data_to_table[4]['type'] = 'number';
//            $data_to_table[5]['text'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//            $data_to_table[5]['id'] = 'time_low';
//            $data_to_table[5]['type'] = 'date';
//            $data_to_table[6]['text'] = 'Дата окончания действия экспертизы ПБ';
//            $data_to_table[6]['id'] = 'date_end';
//            $data_to_table[6]['type'] = 'date';
//            $data_to_table[4]['text'] = 'Давление на входе МКУ (тег)';
//            $data_to_table[4]['id'] = 'tag_p_in';
//            $data_to_table[4]['type'] = 'text';
//            $data_to_table[5]['text'] = 'Давление на выходе МКУ (тег)';
//            $data_to_table[5]['id'] = 'tag_p_out';
//            $data_to_table[5]['type'] = 'text';
            $data_to_table[3]['text'] = 'Состояние крана (тег)';
            $data_to_table[3]['id'] = 'status_kran';
            $data_to_table[3]['type'] = 'text';
        }
        return $data_to_table;
    }

    public function save_tb(Request $request, $type_tb)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $id = RefTb::orderbydesc('id_tb')->first()->id_tb;
            $record_data['id_tb'] = (int)$id + 1;
            $to_ref_tb['id_status'] = 3;
            $to_ref_tb['id_tb'] = $record_data['id_tb'];
            $to_ref_tb['full_name_tb'] = $record_data['full_name_tb'];
            $to_ref_tb['short_name_tb'] = $record_data['short_name_tb'];
            $to_ref_tb['guid_tb'] = $record_data['guid_tb'];
            $to_ref_tb['type_tb'] = $record_data['type_tb'];
            $to_ref_tb['id_obj'] = $record_data['id_obj'];
            unset($record_data['full_name_tb']);
            unset($record_data['short_name_tb']);
            unset($record_data['guid_tb']);
            unset($record_data['type_tb']);
            unset($record_data['id_obj']);
            RefTb::create($to_ref_tb);
            if ($type_tb == 1) {    //если межкрановый участок
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                TagTable::create($to_tag_name);
                MKU::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 2) { // если кран
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['status_kran'] = $record_data['status_kran'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['status_kran']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                TagTable::create($to_tag_name);
                KRANS::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 3) { //если ГПА
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['status_kran'] = $record_data['status_kran'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_for_gpa']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                TagTable::create($to_tag_name);
                GPA::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 4) { //Тех.обвязка
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_p_in']);
                unset($record_data['tag_p_out']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                TagTable::create($to_tag_name);
                TechObv::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 5) { //Лин.рецирк
//                $to_tag_name['id_tb'] = $record_data['id_tb'];
//                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
//                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
//                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
//                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
//                $to_tag_name['typetb'] = $type_tb;
//                unset($record_data['tag_p_in']);
//                unset($record_data['tag_p_out']);
//                unset($record_data['tag_t_in']);
//                unset($record_data['tag_t_out']);
//                TagTable::create($to_tag_name);
//                LineRecirk::create($record_data);
//                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 6) { //Вх. шлейф
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_p_in']);
                unset($record_data['tag_t_in']);
                TagTable::create($to_tag_name);
                InputShleif::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 7) { //Вых. шлейф
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_p_out']);
                unset($record_data['tag_t_out']);
                TagTable::create($to_tag_name);
                OutputShleif::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 8) { //УОГ
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_p_out']);
                unset($record_data['tag_p_in']);
                TagTable::create($to_tag_name);
                CleaningGas::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 9 || $type_tb == 10) { //БПТПГ или УПТИГ
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_p_out']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_t_out']);
                unset($record_data['tag_t_in']);
                TagTable::create($to_tag_name);
                BPTPG::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 11) { //АВО
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
                $to_tag_name['tag_t_out'] = $record_data['tag_t_out'];
                $to_tag_name['tag_t_in'] = $record_data['tag_t_in'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['tag_p_out']);
                unset($record_data['tag_p_in']);
                unset($record_data['tag_t_in']);
                unset($record_data['tag_t_out']);
                TagTable::create($to_tag_name);
                AVO::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            } elseif ($type_tb == 12) { // если кран КЦ
                $to_tag_name['id_tb'] = $record_data['id_tb'];
                $to_tag_name['status_kran'] = $record_data['status_kran'];
//                $to_tag_name['tag_p_in'] = $record_data['tag_p_in'];
//                $to_tag_name['tag_p_out'] = $record_data['tag_p_out'];
                $to_tag_name['typetb'] = $type_tb;
                unset($record_data['status_kran']);
//                unset($record_data['tag_p_in']);
//                unset($record_data['tag_p_out']);
                TagTable::create($to_tag_name);
                KRANS_KC::create($record_data);
                AdminController::log_record('Добавил ТБ ' . $to_ref_tb['short_name_tb']);//пишем в журнал
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
