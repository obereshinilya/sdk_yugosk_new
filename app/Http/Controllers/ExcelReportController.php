<?php

namespace App\Http\Controllers;

use App\Conclusions_industrial_safety;
use App\Events;
use App\Exports\Actual_declarations_Export;
use App\Exports\ConclusionsExport;
use App\Exports\Emergency_drills_Export;
use App\Exports\EventsExport;
use App\Exports\FulfillmentsExport;
use App\Exports\Goals_trans_yugorsk_Export;
use App\Exports\Jas_Export;
use App\Exports\KIPD_internal_checks_Export;
use App\Exports\Kr_dtoip_Export;
use App\Exports\Pat_scheduleExport;
use App\Exports\Perfomance_plan_KiPD_Export;
use App\Exports\Plan_industrial_safety_Export;
use App\Exports\Plan_of_industrial_safety_Export;
use App\Exports\Report_events_Export;

use App\Exports\Sved_avar_Export;
use App\Exports\Result_apk_Export;
use App\Fulfillment_certification;
use App\Http\Controllers\Controller;
use App\Models\Main_models\RefDO;
use App\Models\Reports\ActualDeclarations;
use App\Models\Reports\EmergencyDrills;
use App\Models\Reports\Goals_trans_yugorsk;
use App\Models\Reports\KIPDInternalChecks;
use App\Models\Reports\KR_DTOIP;
use App\Models\Reports\Perfomance_plan_KiPD;
use App\Models\Reports\Plan_industrial_safety;
use App\Models\Reports\ResultApk;
use App\Models\Reports\Sved_avar;
use App\Pat_schedule;
use App\Plan_of_industrial_safety;
use App\Report_events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\DB;

class ExcelReportController extends Controller
{
    public function excel_conclusions_industrial_safety_main()
    {
        ini_set('memory_limit', '-1');
//        set_time_limit( 2147483647);
        $data = Conclusions_industrial_safety::orderby('id')->get();
        $title = 'Реестр заключений экспертизы промышленной безопасности';
        $patch = 'Conclusions_industrial_safety' . Carbon::now() . '.xlsx';
        return Excel::download(new ConclusionsExport($title, $data), $patch);

    }

    public function excel_conclusions_industrial_safety(Request $request)
    {
        $keys = array_keys($request->all());
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode(',', $request[$column]);
                if (isset($data)) {
                    $data = $data->whereIn($column, $fieldset[$column]);
                } else {
                    $data = Conclusions_industrial_safety::orderby('id')->whereIn($column, $fieldset[$column])->get();
                }
            }
        }
        $title = 'Реестр заключений экспертизы промышленной безопасности';
        $patch = 'Conclusions_industrial_safety' . Carbon::now() . '.xlsx';
        return Excel::download(new ConclusionsExport($title, $data), $patch);

    }


    public function excel_events(Request $request)
    {
        $keys = array_keys($request->all());
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                if (isset($data)) {
                    $data = $data->whereIn($column, $fieldset[$column]);
                } else {
                    $data = Events::orderby('id')->whereIn($column, $fieldset[$column]);
                }
            }
        }
        $data_to_table['data'] = $data->get();
        $title = ' Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром»';
        foreach ($data_to_table['data'] as $key => $event) {
            if ($event->date_issue) {
                $data_to_table['date_issue'][$key] = date('d.m.Y', strtotime($event->date_issue));
            } else {
                $data_to_table['date_issue'][$key] = '';

            }
            if ($event->date_base) {
                $data_to_table['date_base'][$key] = date('d.m.Y', strtotime($event->date_base));
            } else {
                $data_to_table['date_base'][$key] = '';
            }
            if ($event->date_repiat) {
                $data_to_table['date_repiat'][$key] = date('d.m.Y', strtotime($event->date_repiat));
            } else {
                $data_to_table['date_repiat'][$key] = '';
            }
            if ($event->date_fact) {
                $data_to_table['date_fact'][$key] = date('d.m.Y', strtotime($event->date_fact));
            } else {
                $data_to_table['date_fact'][$key] = '';
            }
            if ($event->date_update) {
                $data_to_table['date_update'][$key] = date('d.m.Y', strtotime($event->date_update));
            } else {
                $data_to_table['date_update'][$key] = '';
            }
        }
        $patch = 'Events' . Carbon::now() . '.xlsx';

        return Excel::download(new EventsExport($title, $data_to_table), $patch);

    }

    public function excel_fulfillment_certification(Request $request)
    {
        $keys = array_keys($request->all());
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                if (isset($data)) {
                    $data = $data->whereIn($column, $fieldset[$column]);
                } else {
                    $data = DB::table('reports.fulfillment_certification')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.fulfillment_certification.id_do')->whereIn($column, $fieldset[$column]);
                }
            }
        }
        $data_to_table = $data->get();
        $title = ' Выполнение
                            плана-графика аттестации в области промышленной безопасности за ' . $request->year . ' год.';
        $patch = 'Fulfillment_certification' . Carbon::now() . '.xlsx';

        return Excel::download(new FulfillmentsExport($title, $data_to_table), $patch);

    }

    public function excel_pat_schedule(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = DB::table('reports.pat_schedule')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.pat_schedule.id_do')->join('public.ref_opo', 'public.ref_opo.id_opo', '=', 'reports.pat_schedule.id_opo');
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data = $data_one->get();
        $title = ' График
                            комплексных противоаварийных тренировок I - II уровня на опасных производственных объектах
                            ООО «Газпром трансгаз Югорск» на ' . $request->year . ' год.';
        $patch = 'Pat_schedule' . Carbon::now() . '.xlsx';

        return Excel::download(new Pat_scheduleExport($title, $data), $patch);

    }

    public function excel_plan_of_industrial_safety($year, $id_do)
    {
        if ($id_do == 'all') {
            $name_do = 'Дочернее общество. ';
        } else {
            $name_do = RefDO::where('id_do', '=', $id_do)->first()->short_name_do . '. ';
        }
        $data['data'] = Plan_of_industrial_safety::where('id_do', '=', $id_do)->where('year', '=', $year)->get();
        $title = $name_do . ' План работ в области промышленной безопасности за ' . $year . ' год';
        $patch = 'plan_of_industrial_safety' . Carbon::now() . '.xlsx';

        foreach ($data['data'] as $key => $plan) {
            if ($plan->completion_date) {
                $data['completion_date'][$key] = date('d.m.Y', strtotime($plan->completion_date));
            } else {
                $data['completion_date'][$key] = '';
            }
        }
        return Excel::download(new Plan_of_industrial_safety_Export($title, $data), $patch);

    }

    public function excel_actual_declarations(Request $request)
    {
        $keys = array_keys($request->all());
        if ($keys) {
            foreach ($keys as $column) {
                if ($column != '_token' && $column != 'page') {
                    $fieldset[$column] = explode('!!', $request[$column]);
                    if (isset($data_one)) {
                        $data_one->whereIn($column, $fieldset[$column]);
                    } else {
                        $data_one = ActualDeclarations::orderby('id')->whereIn($column, $fieldset[$column]);
                    }
                }
            }
        } else {
            $data_one = ActualDeclarations::orderby('id');
        }
        $data = $data_one->get();

        $title = ' Реестр актуальных
                            деклараций промышленной
                            безопасности
                            опасных производственных объектов ';
        $patch = 'report_actual_declarations' . Carbon::now() . '.xlsx';

        return Excel::download(new Actual_declarations_Export($title, $data), $patch);

    }

    public function excel_emergency_drills(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = DB::table('reports.emergency_drills')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.emergency_drills.id_do');
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data['data'] = $data_one->orderbydesc('date_PAT')->get();
        $title = ' Сведения о
                            противоаварийных тренировках, проведенных на
                            ОПО в ' . $request->year . ' году';
        $patch = 'report_emergency_drills' . Carbon::now() . '.xlsx';
        foreach ($data['data'] as $key => $row) {
            if ($row->date_PAT) {
                $data['date_PAT'][$key] = date('d.m.Y', strtotime($row->date_PAT));
            } else {
                $data['date_PAT'][$key] = '';
            }
        }
        return Excel::download(new Emergency_drills_Export($title, $data), $patch);

    }

    public function excel_report_events(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = DB::table('reports.report_events')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.report_events.id_do');
//        $data = Report_events::where('year', '=', $year)->select('name_do')->groupby('name_do')->get();
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data['data'] = $data_one->get();
        $title = ' Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за ' . $request->year . ' год';
        $patch = 'report_events' . Carbon::now() . '.xlsx';
        foreach ($data['data'] as $key => $row) {
            if ($row->date_update) {
                $data['date_update'][$key] = date('d.m.Y', strtotime($row->date_update));
            } else {
                $data['date_update'][$key] = '';
            }
        }
        return Excel::download(new Report_events_Export($title, $data), $patch);

    }

    public function excel_goals_trans_yugorsk(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = Goals_trans_yugorsk::orderby('id');
//        $data = Report_events::where('year', '=', $year)->select('name_do')->groupby('name_do')->get();
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data['data'] = $data_one->get();
        $title = ' Цели ООО «Газпром
                            трансгаз Югорск» в области
                            производственной безопасности на ' . $request->year . ' год';
        $patch = 'goals_trans_yugorsk' . Carbon::now() . '.xlsx';
        foreach ($data['data'] as $key => $row) {
            if ($row->data_goal) {
                $data['data_goal'][$key] = date('d.m.Y', strtotime($row->data_goal));
            } else {
                $data['data_goal'][$key] = '';
            }
        }
        return Excel::download(new Goals_trans_yugorsk_Export($title, $data), $patch);

    }

    public function excel_kipd_internal_checks(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = DB::table('reports.kipd_internal_checks')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.kipd_internal_checks.id_do');
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data['data'] = $data_one->orderbydesc('date_check')->get();
        $title = ' План корректирующих
                            действий ПБ по внутренним проверкам за ' . $request->year . ' год';
        $patch = 'kipd_internal_checks' . Carbon::now() . '.xlsx';
        foreach ($data['data'] as $key => $row) {
            if ($row->date_act) {
                $data['date_act'][$key] = date('d.m.Y', strtotime($row->date_act));
            } else {
                $data['date_act'][$key] = '';
            }
            if ($row->date_check) {
                $data['date_check'][$key] = date('d.m.Y', strtotime($row->date_check));
            } else {
                $data['date_check'][$key] = '';
            }
            if ($row->date_check_correct) {
                $data['date_check_correct'][$key] = date('d.m.Y', strtotime($row->date_check_correct));
            } else {
                $data['date_check_correct'][$key] = '';
            }
        }
        return Excel::download(new KIPD_internal_checks_Export($title, $data), $patch);

    }

    public function excel_kr_dtoip($year, $id_do)
    {
        $data_from_table = KR_DTOIP::where('year', '=', $year)->where('id_do', '=', $id_do)->get();
        $data = [];
        for ($i = 1; $i < 47; $i++) {
            $data[$i]['date'] = '';
            $data[$i]['plan_year'] = '';
            $data[$i]['plan_month'] = '';
            $data[$i]['fact'] = '';
            $data[$i]['indicator'] = '';
            $data[$i]['num_pp'] = '';
            $data[$i]['name_event'] = '';
            $data['all_fact'] = 0;
            $data['all_plan_year'] = 0;
            $data['all_plan_month'] = 0;
        }
        foreach ($data_from_table as $row) {
            if ($row->date) {
                $data[$row->num_pp]['date'] = date('d.m.Y', strtotime($row->date));
            }
            $data[$row->num_pp]['plan_year'] = $row->plan_year;
            $data[$row->num_pp]['plan_month'] = $row->plan_month;
            $data[$row->num_pp]['fact'] = $row->fact;
            $data[$row->num_pp]['indicator'] = $row->indicator;
            $data[$row->num_pp]['num_pp'] = $row->num_pp;
            $data[$row->num_pp]['name_event'] = $row->name_event;
            $data['all_fact'] += (int)$row->fact;
            $data['all_plan_year'] += (int)$row->plan_year;
            $data['all_plan_month'] += (int)$row->plan_month;
        }
        if ($id_do == 'all') {
            $name_do = 'Дочернее общество. ';
        } else {
            $name_do = RefDO::where('id_do', '=', $id_do)->first()->short_name_do . '. ';
        }
        $title = $name_do . 'Сведения о выполнении графика КР и ДТОиР ОПО за ' . $year . ' год.';
        $patch = 'kr_dtoip' . Carbon::now() . '.xlsx';


        return Excel::download(new Kr_dtoip_Export($title, $data), $patch);

    }

    public function excel_perfomance_plan_KiPD(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = DB::table('reports.perfomance_plan_KiPD')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.perfomance_plan_KiPD.id_do');
//        $data = Report_events::where('year', '=', $year)->select('name_do')->groupby('name_do')->get();
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data['data'] = $data_one->get();
        $title = 'Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром» за ' . $request->year . ' год';
        $patch = 'perfomance_plan_kipd' . Carbon::now() . '.xlsx';
        foreach ($data['data'] as $key => $row) {
            if ($row->deadline) {
                $data['deadline'][$key] = date('d.m.Y', strtotime($row->deadline));
            } else {
                $data['deadline'][$key] = '';
            }
        }
        return Excel::download(new Perfomance_plan_KiPD_Export($title, $data), $patch);

    }

    public function excel_plan_industrial_safety(Request $request)
    {
        $keys = array_keys($request->all());
        $data_one = DB::table('reports.plan_industrial_safety')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.plan_industrial_safety.id_do');
//        $data = Report_events::where('year', '=', $year)->select('name_do')->groupby('name_do')->get();
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode('!!', $request[$column]);
                $data_one->whereIn($column, $fieldset[$column]);
            }
        }
        $data['data'] = $data_one->get();
        $title = 'Сведения о выполнении плана работ в области
                            промышленной
                            безопасности за ' . $request->year . ' год';
        $patch = 'plan_industrial_safety' . Carbon::now() . '.xlsx';
        foreach ($data['data'] as $key => $row) {
            if ($row->period_execution) {
                $data['period_execution'][$key] = date('d.m.Y', strtotime($row->period_execution));
            } else {
                $data['period_execution'][$key] = '';
            }
        }
        return Excel::download(new Plan_industrial_safety_Export($title, $data), $patch);

    }

    public function excel_result_apk($year)
    {
        $data = ResultApk::where('year', '=', $year)->get();
        $title = 'Результаты АПК, корпоративного контроля и государственного надзора за ' . $year . ' год.';
        $patch = 'result_apk' . Carbon::now() . '.xlsx';
        return Excel::download(new Result_apk_Export($title, $data), $patch);


    }

    public function excel_sved_avar($start, $finish)
    {
        $data = Sved_avar::where('data_time', '>=', $start)->where('data_time', '<=', $finish)->get();;
        $title = 'Сведения об аварийности на опасных производственных объектах дочернего общества за с ' . date('d.m.Y', strtotime($start)) . ' по ' . date('d.m.Y', strtotime($finish));
        $patch = 'sved_avar' . Carbon::now() . '.xlsx';
        return Excel::download(new Sved_avar_Export($title, $data), $patch);

    }

    public function excel_jas($start, $end)
    {
        $data['data'] = \App\Models\Jas::where('date', '>=', date('Y-m-d 00:01', strtotime($start)))->where('date', '<=', date('Y-m-d 23:59', strtotime($end)))->orderbydesc('id')->where('auto_generate', '=', true)->get();
        foreach ($data['data'] as $key => $jas) {
            $data['date'][$key] = date('d.m.Y H:m:s', strtotime($jas->date));
        }
        $title = 'Журнал аварийных событий за период с ' . date('d.m.Y', strtotime($start)) . ' по ' . date('d.m.Y', strtotime($end));
        $patch = 'jas' . Carbon::now() . '.xlsx';
        return Excel::download(new Jas_Export($title, $data), $patch);


    }
}
