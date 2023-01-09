<?php

namespace App\Http\Controllers;

use App\Models\Main_models\KRANS;
use App\Models\Main_models\MKU;
use App\Models\Main_models\RefDO;
use App\Models\Main_models\RefObj;
use App\Models\Main_models\RefTb;
use App\Models\Main_models\TagTable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpoController extends Controller
{
    public function to_lower_tag ()
    {
        foreach (TagTable::get() as $row){
            $row->update(['tag_p_in'=>mb_strtolower($row->tag_p_in)]);
            $row->update(['tag_p_out'=>mb_strtolower($row->tag_p_out)]);
            $row->update(['tag_t_in'=>mb_strtolower($row->tag_t_in)]);
            $row->update(['tag_t_out'=>mb_strtolower($row->tag_t_out)]);
            $row->update(['status_kran'=>mb_strtolower($row->status_kran)]);
        }
    }
    public function view_ks ()
    {
        AdminController::log_record('Открыл схему КЦ');//пишем в журнал
        return view('web.ks');
    }
    public function get_status_tb_kc ()
    {
        $data = RefTb::wherebetween('type_tb', [3, 11])->
        join('public.typestatus', 'public.ref_tb.id_status','=' ,  'public.typestatus.id_status')
            ->select('typestatus.class', 'ref_tb.id_tb', 'ref_tb.type_tb')->get();
        $out['class'] = $data->pluck('class');
        $out['id_tb'] = $data->pluck('id_tb');
        return  $out;
    }
    public function get_status_kran_kc ()
    {
        return  RefTb::where('type_tb', '=', 12)->
        leftjoin('public.krans_kc', 'public.ref_tb.id_tb','=' ,  'public.krans_kc.id_tb')->
        select('ref_tb.id_tb','ref_tb.full_name_tb', 'krans_kc.status')->
        get();
    }

    public function view_opo ()
    {
        AdminController::log_record('Открыл схему Краснотурьинского ЛПУ МГ');//пишем в журнал
        return view('web.opo');
    }
    public function get_status_tb(){
        return  RefTb::where('type_tb', '<', 3)->
        join('public.typestatus', 'public.ref_tb.id_status','=' ,  'public.typestatus.id_status')->
        leftjoin('public.krans', 'public.ref_tb.id_tb','=' ,  'public.krans.id_tb')->
            select('typestatus.*', 'ref_tb.*', 'krans.status')->
        get();
    }
    public function get_status_kc(){
        return RefObj::where('type_obj', '=', '2')->join('public.typestatus', 'public.ref_obj.id_status','=' ,  'public.typestatus.id_status')->orderby('id_obj')->get();
    }
    public function get_status_line_kc(){
        return RefTb::wherein('id_tb', [5, 6, 25, 26, 43, 42, 60, 59, 77, 78, 94, 95])->join('public.typestatus', 'public.ref_tb.id_status','=' ,  'public.typestatus.id_status')->orderby('id_tb')->select('id_tb', 'class')->get();
    }
    public function get_status_do(){
        return DB::table('public.ref_do')->
        join('public.typestatus', 'public.ref_do.id_status','=' ,  'public.typestatus.id_status')->
        get()->first()->class;
    }
    public function get_km(){
        return DB::table('public.ref_tb')->where('public.ref_tb.type_tb', '=', 2)->
            join('public.krans', 'public.ref_tb.id_tb','=' ,  'public.krans.id_tb')->select('public.krans.l_kran', 'public.krans.id_tb')->
            get()->toArray();
    }
    public function get_p_t_kc(){
        return DB::table('public.param_kc')->get();
    }
    public function dataModalWindowMKU($id_tb){
        //начато, закончу позже
        $from_ref_tb = RefTb::where('id_tb', '=', $id_tb)->
        join('public.typetb', 'public.ref_tb.type_tb','=' ,  'public.typetb.type_tb')->
            join('public.typestatus', 'public.ref_tb.id_status','=' ,  'public.typestatus.id_status')
                ->select('id_tb', 'full_name_tb', 'descstatus', 'nametable', 'class')->first()->toArray();
        //Описание для МКУ
        $comment_rows['mku']['p_project']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['mku']['p_in']['desc'] = 'Давление на входе МКУ (кгс/см²)';
        $comment_rows['mku']['p_out']['desc'] = 'Давление на выходе МКУ (кгс/см²)';
        $comment_rows['mku']['delta_p']['desc'] = 'Градиент давления, (кгс/см²)';
        $comment_rows['mku']['p_low']['desc'] = 'Расчетное давление по классу безопасности "Низкий", кгс/см² ';
        $comment_rows['mku']['v_p']['desc'] = 'Скорость падения давления, (кгс/см²)/мин';
        $comment_rows['mku']['v_p_km']['desc'] = 'Скорость падения давления на погонный километр, (кгс/см²)/(мин*км)';
        $comment_rows['mku']['time_low']['desc'] = 'Расчетная дата перехода участка в класс безопасности "Низкий"';
        $comment_rows['mku']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['mku']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
        $comment_rows['mku']['t_in']['desc'] = 'Температура газа в входе МКУ (°С)';
        $comment_rows['mku']['t_out']['desc'] = 'Температура газа на выходе МКУ (°С)';
        //Описание для кранов
        $comment_rows['krans']['p_1']['desc'] = 'Давление входное, кгс/см²';
        $comment_rows['krans']['p_2']['desc'] = 'Давление выходное, кгс/см²)';
        $comment_rows['krans']['delta_p']['desc'] = 'Перепад давления на кране, кгс/см²';
//        $comment_rows['krans']['delta_p_max']['desc'] = 'Перепад давления на кране (макс), кгс/см²';
//        $comment_rows['krans']['time_low']['desc'] = 'Расчетная дата перехода в класс безопасности "Низкий"';
//        $comment_rows['krans']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
//        $comment_rows['krans']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
        //Описание вх шлейфа
        $comment_rows['input_shleif']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['input_shleif']['p_in']['desc'] = 'Давление на выходе крана №7 (кгс/см²)';
        $comment_rows['input_shleif']['t_in']['desc'] = 'Температура на выходе крана №7 (°С)';
        $comment_rows['input_shleif']['n']['desc'] = 'Общее количество допустимых дефектов';
        $comment_rows['input_shleif']['n_w']['desc'] = 'Общее количество дефектов в работоспособном состоянии';
        $comment_rows['input_shleif']['n_lim']['desc'] = 'Общее количество дефектов в предельном состоянии';
        $comment_rows['input_shleif']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['input_shleif']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
        //Описание вых шлейфа
        $comment_rows['output_shleif']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['output_shleif']['p_out']['desc'] = 'Давление на входе крана №8 (кгс/см²)';
        $comment_rows['output_shleif']['t_out']['desc'] = 'Температура на входе крана №8 (°С)';
        $comment_rows['output_shleif']['n']['desc'] = 'Общее количество допустимых дефектов';
        $comment_rows['output_shleif']['n_w']['desc'] = 'Общее количество дефектов в работоспособном состоянии';
        $comment_rows['output_shleif']['n_lim']['desc'] = 'Общее количество дефектов в предельном состоянии';
        $comment_rows['output_shleif']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['output_shleif']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
        //Описание лин рециркуляции
        $comment_rows['line_recirc']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['line_recirc']['p_out']['desc'] = 'Давление перед краном №8 (кгс/см²)';
        $comment_rows['line_recirc']['p_in']['desc'] = 'Давление после крана №7 (кгс/см²)';
        $comment_rows['line_recirc']['t_out']['desc'] = 'Температура перед краном №8 (°С)';
        $comment_rows['line_recirc']['t_in']['desc'] = 'Температура после крана №7 (°С)';
        $comment_rows['line_recirc']['n']['desc'] = 'Общее количество допустимых дефектов';
        $comment_rows['line_recirc']['n_w']['desc'] = 'Общее количество дефектов в работоспособном состоянии';
        $comment_rows['line_recirc']['n_lim']['desc'] = 'Общее количество дефектов в предельном состоянии';
        $comment_rows['line_recirc']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['line_recirc']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
//        //АВО
        $comment_rows['avo']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['avo']['p_out']['desc'] = 'Давление на выходе АВО (кгс/см²)';
        $comment_rows['avo']['p_in']['desc'] = 'Давление на входе АВО (кгс/см²)';
        $comment_rows['avo']['t_out']['desc'] = 'Температура на выходе АВО (°С)';
        $comment_rows['avo']['t_in']['desc'] = 'Температура на входе АВО (°С)';
        $comment_rows['avo']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['avo']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
//        //УОГ
        $comment_rows['cleaning_gas']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['cleaning_gas']['p_out']['desc'] = 'Давление на выходе УОГ (кгс/см²)';
        $comment_rows['cleaning_gas']['p_in']['desc'] = 'Давление на входе УОГ (кгс/см²)';
        $comment_rows['cleaning_gas']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['cleaning_gas']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
//        //Тех обвязка
        $comment_rows['tech_obv']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['tech_obv']['p_in']['desc'] = 'Давление на выходе УОГ (кгс/см²)';
        $comment_rows['tech_obv']['p_out']['desc'] = 'Давление на входе АВО (кгс/см²)';
        $comment_rows['tech_obv']['t_in']['desc'] = 'Температура на выходе УОГ (°С)';
        $comment_rows['tech_obv']['t_out']['desc'] = 'Температура на входе АВО (°С)';
        $comment_rows['tech_obv']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['tech_obv']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
        $comment_rows['tech_obv']['n']['desc'] = 'Общее количество допустимых дефектов';
        $comment_rows['tech_obv']['n_w']['desc'] = 'Общее количество дефектов в работоспособном состоянии';
        $comment_rows['tech_obv']['n_lim']['desc'] = 'Общее количество дефектов в предельном состоянии';
//        //ГПА
        $comment_rows['gpa']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['gpa']['p_in']['desc'] = 'Давление на входе ГПА (кгс/см²)';
        $comment_rows['gpa']['p_out']['desc'] = 'Давление на выходе ГПА (кгс/см²)';
        $comment_rows['gpa']['t_in']['desc'] = 'Температура на входе ГПА (°С)';
        $comment_rows['gpa']['t_out']['desc'] = 'Температура на выходе ГПА (°С)';
        $comment_rows['gpa']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['gpa']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';
        $comment_rows['gpa']['koef']['desc'] = 'Коэффициент технического состояния по мощности';
//        //БПТПГ
        $comment_rows['bptpg']['p_w']['desc'] = 'Разрешенное рабочее давление (кгс/см²)';
        $comment_rows['bptpg']['p_in']['desc'] = 'Давление газа на входе (кгс/см²)';
        $comment_rows['bptpg']['p_tg']['desc'] = 'Давление топливного газа (кгс/см²)';
        $comment_rows['bptpg']['p_pg']['desc'] = 'Давление пускового газа (кгс/см²)';
        $comment_rows['bptpg']['p_ig']['desc'] = 'Давление импульсного газа (кгс/см²)';
        $comment_rows['bptpg']['date_end']['desc'] = 'Дата окончания действия экспертизы ПБ';
        $comment_rows['bptpg']['left_time']['desc'] = 'Действие экспертизы ПБ закончится через (дней)';

        //Добавление значения из таблицы ТБ
        $from_tb_table = DB::table('public.'.$from_ref_tb['nametable'])->where('id_tb', '=', $id_tb)->
            select('*')->first();
        $keys = array_keys($comment_rows[$from_ref_tb['nametable']]);
        foreach ($keys as $key){
            $comment_rows[$from_ref_tb['nametable']][$key]['value'] = $from_tb_table->$key;
        }
        //Добавление общей информации по ТБ
        $comment_rows[$from_ref_tb['nametable']]['full_name']['desc'] = 'Наименование ТБ';
        $comment_rows[$from_ref_tb['nametable']]['full_name']['value'] = $from_ref_tb['full_name_tb'];
        $comment_rows[$from_ref_tb['nametable']]['full_name']['bad_param'] = $from_tb_table->indication_par;
        $comment_rows[$from_ref_tb['nametable']]['descstatus']['desc'] = 'Текущее состояние';
        $comment_rows[$from_ref_tb['nametable']]['descstatus']['value'] = $from_ref_tb['descstatus'];
        $comment_rows[$from_ref_tb['nametable']]['descstatus']['class'] = $from_ref_tb['class'];
        return $comment_rows[$from_ref_tb['nametable']];
    }


}
