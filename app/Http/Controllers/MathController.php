<?php

namespace App\Http\Controllers;

use App\Models\Jas;
use App\Models\Main_models\AllIndicators;
use App\Models\Main_models\KRANS;
use App\Models\Main_models\MKU;
use App\Models\Main_models\RefDO;
use App\Models\Main_models\RefTb;
use App\Models\Reports\EmergencyDrills;
use App\Models\Reports\Goals_trans_yugorsk;
use App\Models\Reports\KIPDInternalChecks;
use App\Models\Reports\KR_DTOIP;
use App\Models\Reports\Perfomance_plan_KiPD;
use App\Models\Reports\Plan_industrial_safety;
use App\Models\Reports\ResultApk;
use App\Models\Reports\Sved_avar;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MathController extends Controller
{
	public function check_update_status(){
		$data = DB::select('public.check_update_status()');
		return true;
	}
    public function update_kipd_internal_checks()
    {
        $kipd_data = KIPDInternalChecks::where('year', '=', date('Y'))->get();
        foreach ($kipd_data as $row){
            if ($row->date_check_correct){   //если есть дата выполнения
                if (strtotime($row->date_check_correct) <=strtotime($row->date_check)){   //если выполнили до дедлайна
                    $row->update(['indicator'=>1]);
                }else{
                    $row->update(['indicator'=>0]);
                    if ($row->in_use){
                        if (count(Jas::where('comment', '=', 'Обратите внимание на запись №'.$row->id)->where('elem_opo', '=', 'План корректирующих действий ПБ по внутренним проверкам')->get())){

                        }else{
                            Jas::create([
                                'opo'=>'Док.блок',
                                'elem_opo'=>'План корректирующих действий ПБ по внутренним проверкам',
                                'auto_generate'=>true,
                                'sobitie'=>'Окончание срока выполнения',
                                'comment'=>'Обратите внимание на запись №'.$row->id,
                            ]);
                        }
                    }
                }
            }else{
                if (strtotime(date('Y-m-d')) <=strtotime($row->date_check)){   //если срок еще не прошел
                    $row->update(['indicator'=>1]);
                }else{
                    $row->update(['indicator'=>0]);
                    if ($row->in_use){
                        if (count(Jas::where('comment', '=', 'Обратите внимание на запись №'.$row->id)->where('elem_opo', '=', 'План корректирующих действий ПБ по внутренним проверкам')->get())){

                        }else{
                            Jas::create([
                                'opo'=>'Док.блок',
                                'elem_opo'=>'План корректирующих действий ПБ по внутренним проверкам',
                                'auto_generate'=>true,
                                'sobitie'=>'Окончание срока выполнения',
                                'comment'=>'Обратите внимание на запись №'.$row->id,
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function update_perfomance_plan_KiPD()
    {
        $kipd_data = Perfomance_plan_KiPD::where('year', '=', date('Y'))->get();
        foreach ($kipd_data as $row){
            if ($row->date_check_correct){   //если выполнено
                    $row->update(['indicative_indicat'=>1]);
            }else{
                if (strtotime(date('Y-m-d')) <=strtotime($row->deadline)){   //если срок еще не прошел
                    $row->update(['indicative_indicat'=>1]);
                }else{
                    $row->update(['indicative_indicat'=>0]);
                    if (count(Jas::where('comment', '=', 'Обратите внимание на запись №'.$row->id)->where('elem_opo', '=', 'Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ')->get())){

                    }else{
                        Jas::create([
                            'opo'=>'Док.блок',
                            'elem_opo'=>'Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ',
                            'auto_generate'=>true,
                            'sobitie'=>'Окончание срока выполнения',
                            'comment'=>'Обратите внимание на запись №'.$row->id,
                        ]);
                    }
                }
            }
        }
    }
    public function update_plan_industrial_safety()
    {
        $kipd_data = Plan_industrial_safety::where('year', '=', date('Y'))->get();
        foreach ($kipd_data as $row){
            if ($row->completion_mark){   //если выполнено
                $row->update(['indicative_indicat'=>1]);
            }else{
                if (strtotime(date('Y-m-d')) <=strtotime($row->period_execution)){   //если срок еще не прошел
                    $row->update(['indicative_indicat'=>1]);
                }else{
                    $row->update(['indicative_indicat'=>0]);
                    if (count(Jas::where('comment', '=', 'Обратите внимание на запись №'.$row->id)->where('elem_opo', '=', 'Сведения о выполнении плана работ в области промышленной безопасности')->get())){

                    }else{
                        Jas::create([
                            'opo'=>'Док.блок',
                            'elem_opo'=>'Сведения о выполнении плана работ в области промышленной безопасности',
                            'auto_generate'=>true,
                            'sobitie'=>'Окончание срока выполнения',
                            'comment'=>'Обратите внимание на запись №'.$row->id,
                        ]);
                    }
                }
            }
        }
    }
    public function update_goals_trans_yugorsk()
    {
        $kipd_data = Goals_trans_yugorsk::where('year', '=', date('Y'))->get();
        foreach ($kipd_data as $row){
            if ($row->completion_mark == '1'){   //если выполнено
                $row->update(['indicative_indicator'=>1]);
            }else{
                if (strtotime(date('Y-m-d')) <=strtotime($row->data_goal)){   //если срок еще не прошел
                    $row->update(['indicative_indicator'=>1]);
                }else{
                    $row->update(['indicative_indicator'=>0]);
                    if (count(Jas::where('comment', '=', 'Обратите внимание на запись №'.$row->id)->where('elem_opo', '=', 'Цели ООО «Газпром трансгаз Югорск» в области ПБ')->get())){

                    }else{
                        Jas::create([
                            'opo'=>'Док.блок',
                            'elem_opo'=>'Цели ООО «Газпром трансгаз Югорск» в области ПБ',
                            'auto_generate'=>true,
                            'sobitie'=>'Окончание срока выполнения',
                            'comment'=>'Обратите внимание на запись №'.$row->id,
                        ]);
                    }
                }
            }
        }
    }
    public function create_record_indicator()
    {
        $data_to_table = [];
        try {
            $res_apk = ResultApk::where('year', '=', date('Y'))->get();
            $ind_graph = 0.3;
            $ind_apk = 0.7;
            $ind_rosteh = 1;
            $ind_gaz = 1;
            foreach ($res_apk as $row){
                if ($row->ind_rosteh < $ind_rosteh){
                    $ind_rosteh = $row->ind_rosteh;
                }
                if ($row->ind_graph < $ind_graph){
                    $ind_graph = $row->ind_graph;
                }
                if ($row->ind_repiat_apk < $ind_apk){
                    $ind_apk = $row->ind_repiat_apk;
                }
                if ($row->ind_repiat_gaznadzor < $ind_gaz){
                    $ind_gaz = $row->ind_repiat_gaznadzor;
                }
            }
            $data_to_table['ind_result_apk'] = $ind_graph + $ind_apk;
            $data_to_table['ind_rosteh'] = $ind_rosteh;
            $data_to_table['ind_gaznadzor'] = $ind_gaz;
        }catch (\Throwable $e){
            $data_to_table['ind_result_apk'] = 1;
            $data_to_table['ind_rosteh'] = 1;
            $data_to_table['ind_gaznadzor'] = 1;
        }
        $summ_ind = (float)$data_to_table['ind_result_apk'] +  (float)$data_to_table['ind_rosteh'] +  (float)$data_to_table['ind_gaznadzor'];
        $data_to_table['ind_kipd_internal_checks'] = KIPDInternalChecks::where('year', '=', date('Y'))->where('in_use', '=', true)->get()->min('indicator');
        if ($data_to_table['ind_kipd_internal_checks'] == null){
            $data_to_table['ind_kipd_internal_checks'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_kipd_internal_checks'];
        $data_to_table['ind_performance_plan_kipd'] = Perfomance_plan_KiPD::where('year', '=', date('Y'))->get()->min('indicative_indicat');
        if ($data_to_table['ind_performance_plan_kipd'] == null){
            $data_to_table['ind_performance_plan_kipd'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_performance_plan_kipd'];
        $data_to_table['ind_sved_avar'] = Sved_avar::where('year', '=', date('Y'))->get()->min('indikativn_pokazat');
        if ($data_to_table['ind_sved_avar'] == null){
            $data_to_table['ind_sved_avar'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_sved_avar'];

        $data_to_table['ind_emergency_drills'] = EmergencyDrills::where('year', '=', date('Y'))->get()->min('indicative_indicator');
        if ($data_to_table['ind_emergency_drills'] == null){
            $data_to_table['ind_emergency_drills'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_emergency_drills'];
        $data_to_table['ind_plan_industial_safety'] = Plan_industrial_safety::where('year', '=', date('Y'))->get()->min('indicative_indicat');
        if ($data_to_table['ind_plan_industial_safety'] == null){
            $data_to_table['ind_plan_industial_safety'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_plan_industial_safety'];
        $data_to_table['ind_kr_dtoip'] = KR_DTOIP::where('year', '=', date('Y'))->where('check', '=', true)->get()->min('indicator');
        if ($data_to_table['ind_kr_dtoip'] == null){
            $data_to_table['ind_kr_dtoip'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_kr_dtoip'];
        $data_to_table['ind_goals'] = Goals_trans_yugorsk::where('year', '=', date('Y'))->get()->min('indicative_indicator');
        if ($data_to_table['ind_goals'] == null){
            $data_to_table['ind_goals'] = 1;
        }
        $summ_ind += (float)$data_to_table['ind_goals'];
        $data_to_table['sum_ind'] = $summ_ind;
        $data_to_table['date'] = date('Y-m-d');
        AllIndicators::create($data_to_table);
    }

    public function get_indicator($year, $id){
        return AllIndicators::orderbydesc('date')->where('date', '>=', date($year.'-01-01'))->where('date', '<', date($year.'-12-31'))->where('id_do',$id)->get()->toArray();
    }
}
