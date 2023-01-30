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


    public function excel_events($year)
    {
        $data['data'] = Events::where('year', '=', $year)->get();
        $title = ' Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром» за ' . $year . ' год';
        foreach ($data['data'] as $key => $event) {
            if ($event->date_issue) {
                $data['date_issue'][$key] = date('d.m.Y', strtotime($event->date_issue));
            } else {
                $data['date_issue'][$key] = '';

            }
            if ($event->date_base) {

                $data['date_base'][$key] = date('d.m.Y', strtotime($event->date_base));
            } else {
                $data['date_base'][$key] = '';

            }
            if ($event->date_repiat) {
                $data['date_repiat'][$key] = date('d.m.Y', strtotime($event->date_repiat));

            } else {
                $data['date_repiat'][$key] = '';

            }
            if ($event->date_fact) {
                $data['date_fact'][$key] = date('d.m.Y', strtotime($event->date_fact));

            } else {
                $data['date_fact'][$key] = '';

            }
            if ($event->date_update) {
                $data['date_update'][$key] = date('d.m.Y', strtotime($event->date_update));
            } else {
                $data['date_update'][$key] = '';

            }
        }
        $patch = 'Events' . Carbon::now() . '.xlsx';

        return Excel::download(new EventsExport($title, $data), $patch);

    }

    public function excel_fulfillment_certification($year)
    {
        $data = Fulfillment_certification::where('year', '=', $year)->get();
        $title = ' Выполнение
                            плана-графика аттестации в области промышленной безопасности за ' . $year . ' год';
        $patch = 'Fulfillment_certification' . Carbon::now() . '.xlsx';

        return Excel::download(new FulfillmentsExport($title, $data), $patch);

    }

    public function excel_pat_schedule($year)
    {
        $data = Pat_schedule::where('year', '=', $year)->get();
        $title = ' График
                            комплексных противоаварийных тренировок I - II уровня на опасных производственных объектах
                            ООО «Газпром трансгаз Югорск» на ' . $year . ' год';
        $patch = 'Pat_schedule' . Carbon::now() . '.xlsx';

        return Excel::download(new Pat_scheduleExport($title, $data), $patch);

    }

    public function excel_plan_of_industrial_safety($year)
    {
        $data['data'] = Plan_of_industrial_safety::where('year', '=', $year)->get();
        $title = ' План работ в области промышленной безопасности за ' . $year . ' год';
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

    public function excel_actual_declarations()
    {
        $data = ActualDeclarations::orderby('id')->get();
        $title = ' Реестр актуальных
                            деклараций промышленной
                            безопасности
                            опасных производственных объектов ';
        $patch = 'report_actual_declarations' . Carbon::now() . '.xlsx';

        return Excel::download(new Actual_declarations_Export($title, $data), $patch);

    }

    public function excel_emergency_drills($year)
    {
        $data['data'] = EmergencyDrills::where('year', '=', $year)->get();
        $title = ' Сведения о
                            противоаварийных тренировках, проведенных на
                            ОПО в ' . $year . ' году';
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

    public function excel_report_events($year)
    {
        $data['data'] = Report_events::where('year', '=', $year)->get();
        $title = ' Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за ' . $year . ' год';
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

    public function excel_goals_trans_yugorsk($year)
    {
        $data['data'] = Goals_trans_yugorsk::where('year', '=', $year)->get();
        $title = ' Цели ООО «Газпром
                            трансгаз Югорск» в области
                            производственной безопасности на ' . $year . ' год';
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

    public function excel_kipd_internal_checks($year)
    {
        $data['data'] = KIPDInternalChecks::where('year', '=', $year)->get();
        $title = ' План корректирующих
                            действий ПБ по внутренним проверкам за ' . $year . ' год';
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

    public function excel_kr_dtoip($year)
    {
        $data_from_table = KR_DTOIP::where('year', '=', $year)->get();
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
        $title = 'Сведения о выполнении графика КР и ДТОиР ОПО за ' . $year . ' год.';
        $patch = 'kr_dtoip' . Carbon::now() . '.xlsx';


        return Excel::download(new Kr_dtoip_Export($title, $data), $patch);

    }

    public function excel_perfomance_plan_KiPD($year)
    {
        $data['data'] = Perfomance_plan_KiPD::where('year', '=', $year)->get();
        $title = 'Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром» за ' . $year . ' год';
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

    public function excel_plan_industrial_safety($year)
    {
        $data['data'] = Plan_industrial_safety::where('year', '=', $year)->get();
        $title = 'Сведения о выполнении плана работ в области
                            промышленной
                            безопасности за ' . $year . ' год';
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
