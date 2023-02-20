<?php

namespace App\Http\Controllers;

use App\Events;
use App\Jas;
use App\Models\APK_SDK;
use App\Models\Main_models\RefDO;
use App\Models\Operational_safety;
use App\Models\Ref_obj;
use App\Models\Report_history\ElementStatus_day;
use App\Models\Report_history\QualityCriteria;
use App\Models\Report_history\RepiatReport;
use App\Models\Report_history\ResultPk;
use App\Models\Report_history\ScenaReport;
use App\Models\Report_history\StatusOpo;
use App\Models\Report_history\ViolationsReport;
use App\Models\Reports\ActualDeclarations;
use App\Models\Reports\EmergencyDrills;
use App\Models\Reports\Goals_trans_yugorsk;
use App\Models\Reports\KIPDInternalChecks;
use App\Models\Reports\KR_DTOIP;
use App\Models\Reports\Perfomance_plan_KiPD;
use App\Models\Reports\Plan_industrial_safety;
use App\Models\Reports\ResultApk;
use App\Models\Reports\Sved_avar;
use App\Models\Rtn\Data_check_out;
use App\Models\XML_journal;
use App\Pat_schedule;
use App\Plan_of_industrial_safety;
use App\Ref_opo;
use App\Report_events;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class PdfReportController extends Controller
{
    public function pdf_xml_journal($start, $finish)
    {
        $ver_opo = XML_journal::where('date', '<=', $finish)->where('date', '>=', $start)->orderByDesc('id')->get();
        $i = 0;
        if (empty($ver_opo->first()->fullDescOPO)) {
            $data['fullDescOPO'][$i] = "";
            $data['regNumOPO'][$i] = " ";
            $data['ip_opo'][$i] = " ";
            $data['status'][$i] = " ";
            $data['date'][$i] = " ";
            $data['time'][$i] = " ";
            $data['id'][$i] = "Журнал пуст";
        } else {
            foreach ($ver_opo as $ver) {
                $data['fullDescOPO'][$i] = $ver->fullDescOPO;
                $data['regNumOPO'][$i] = $ver->regNumOPO;
                $data['ip_opo'][$i] = $ver->ip_opo;
                $data['status'][$i] = $ver->status;
                $data['date'][$i] = $ver->date;
                $data['time'][$i] = $ver->time;
                $data['id'][$i] = $ver->id;
                $i++;
            }
        }

        $data['title'] = 'Журнал отправки XML в период с' . ' ' . $start . 'по' . ' ' . $finish;
        $patch = 'xml_journal' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf.pdf_xml_journal', compact('data'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_actual_declarations(Request $request)
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
        $title = 'Реестр актуальных деклараций промышленной безопасности опасных производственных объектов';
        $patch = 'actual_declarations' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_actual_declarations', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_emergency_drills(Request $request)
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
        $title = 'Сведения о
                            противоаварийных тренировках, проведенных на
                            опасных производственных объектах в ' . $request->year . ' году';
        $patch = 'emergency_drills' . Carbon::now() . '.pdf';
        foreach ($data['data'] as $key => $row) {
            if ($row->date_PAT) {
                $data['date_PAT'][$key] = date('d.m.Y', strtotime($row->date_PAT));
            } else {
                $data['date_PAT'][$key] = '';
            }
        }
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_emergency_drills', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_goals_trans_yugorsk(Request $request)
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
        $title = 'Цели ООО «Газпром
                            трансгаз Югорск» в области
                            производственной безопасности на ' . $request->year . ' год';
        $patch = 'goals_trans_yugorsk' . Carbon::now() . '.pdf';
        foreach ($data['data'] as $key => $row) {
            if ($row->data_goal) {
                $data['data_goal'][$key] = date('d.m.Y', strtotime($row->data_goal));
            } else {
                $data['data_goal'][$key] = '';
            }
        }
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_goals_trans_yugorsk', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_perfomance_plan_KiPD(Request $request)
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
        $patch = 'perfomance_plan_KiPD' . Carbon::now() . '.pdf';
        foreach ($data['data'] as $key => $row) {
            if ($row->deadline) {
                $data['deadline'][$key] = date('d.m.Y', strtotime($row->deadline));
            } else {
                $data['deadline'][$key] = '';
            }
        }
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_perfomance_plan_KiPD', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_plan_industrial_safety(Request $request)
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
        $patch = 'plan_industrial_safety' . Carbon::now() . '.pdf';
        foreach ($data['data'] as $key => $row) {
            if ($row->period_execution) {
                $data['period_execution'][$key] = date('d.m.Y', strtotime($row->period_execution));
            } else {
                $data['period_execution'][$key] = '';
            }
        }
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_plan_industrial_safety', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_kipd_internal_checks(Request $request)
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
        $data['data'] = $data_one->orderbydesc('date_check')->get();;
        $title = 'План корректирующих
                            действий ПБ по внутренним проверкам за ' . $request->year . ' год.';
        $patch = 'kipd_internal_checks' . Carbon::now() . '.pdf';
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
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_kipd_internal_checks', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_result_apk($year, $type)
    {
        $data = ResultApk::where('year', '=', $year)->get();
        $title = 'Результаты АПК, корпоративного контроля и государственного надзора за ' . $year . ' год.';
        $patch = 'result_apk' . Carbon::now() . '.pdf';
        switch ($type) {
            case 'apk':
                $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_result_apk_apk', compact('data', 'title'))->setPaper('a4', 'landscape');

                break;
            case 'gazprom':
                $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_result_apk_gazprom', compact('data', 'title'))->setPaper('a4', 'landscape');

                break;
            case 'rostech':
                $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_result_apk_rostech', compact('data', 'title'))->setPaper('a4', 'landscape');

                break;

        }
        return $pdf->download($patch);

    }

    public function pdf_sved_avar($start, $finish)
    {
        $data = Sved_avar::where('data_time', '>=', $start)->where('data_time', '<=', $finish)->get();
        $title = 'Сведения об аварийности на опасных производственных объектах дочернего общества за с ' . date('d.m.Y', strtotime($start)) . ' по ' . date('d.m.Y', strtotime($finish));
        $patch = 'sved_avar' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_sved_avar', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_report_events(Request $request)
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
        $title = 'Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за ' . $request->year . ' год.';
        $patch = 'report_events' . Carbon::now() . '.pdf';
        foreach ($data['data'] as $key => $row) {
            if ($row->date_update) {
                $data['date_update'][$key] = date('d.m.Y', strtotime($row->date_update));
            } else {
                $data['date_update'][$key] = '';
            }
        }
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_report_events', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_events(Request $request)
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
        $title = 'Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром»';
        $patch = 'events' . Carbon::now() . '.pdf';
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
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_events', compact('data_to_table', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_kr_dtoip($year, $id_do)
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
        $patch = 'kr_dtoip' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_kr_dtoip', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);
    }

    public function pdf_plan_of_industrial_safety($year, $id_do)
    {
        $data['data'] = Plan_of_industrial_safety::where('year', '=', $year)->where('id_do', '=', $id_do)->get();
        if ($id_do == 'all') {
            $name_do = 'Дочернее общество. ';
        } else {
            $name_do = RefDO::where('id_do', '=', $id_do)->first()->short_name_do . '. ';
        }
        $title = $name_do . 'План работ в области промышленной безопасности за ' . $year . ' год';
        $patch = 'plan_of_industrial_safety' . Carbon::now() . '.pdf';
        foreach ($data['data'] as $key => $plan) {
            if ($plan->completion_date) {
                $data['completion_date'][$key] = date('d.m.Y', strtotime($plan->completion_date));
            } else {
                $data['completion_date'][$key] = '';
            }
        }
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_plan_of_industrial_safety', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_pat_schedule(Request $request)
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
        $title = 'График комплексных противоаварийных тренировок I - II уровня на опасных производственных объектах ООО «Газпром трансгаз Югорск» на ' . $request->year . ' год';
        $patch = 'pat_schedule' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_pat_schedule', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_jas($start, $end)
    {
        $data['data'] = \App\Models\Jas::where('date', '>=', date('Y-m-d 00:01', strtotime($start)))->where('date', '<=', date('Y-m-d 23:59', strtotime($end)))->orderbydesc('id')->where('auto_generate', '=', true)->get();
        foreach ($data['data'] as $key => $jas) {
            $data['date'][$key] = date('d.m.Y H:m:s', strtotime($jas->date));
        }
        $title = 'Журнал аварийных событий за период с ' . date('d.m.Y', strtotime($start)) . ' по ' . date('d.m.Y', strtotime($end));
        $patch = 'jas' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_jas', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }
}
