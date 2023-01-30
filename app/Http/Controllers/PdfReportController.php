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

    public function pdf_actual_declarations()
    {
        $data = ActualDeclarations::orderby('id')->get();
        $title = 'Реестр актуальных деклараций промышленной безопасности опасных производственных объектов';
        $patch = 'actual_declarations' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_actual_declarations', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_emergency_drills($year)
    {
        $data['data'] = EmergencyDrills::where('year', '=', $year)->orderbyDesc('name_branch')->orderbydesc('date_PAT')->get();
        $title = 'Сведения о
                            противоаварийных тренировках, проведенных на
                            опасных производственных объектах в ' . $year . ' году';
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

    public function pdf_goals_trans_yugorsk($year)
    {
        $data['data'] = Goals_trans_yugorsk::where('year', '=', $year)->get();
        $title = 'Цели ООО «Газпром
                            трансгаз Югорск» в области
                            производственной безопасности на ' . $year . ' год';
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

    public function pdf_perfomance_plan_KiPD($year)
    {
        $data['data'] = Perfomance_plan_KiPD::where('year', '=', $year)->get();
        $title = 'Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром» за ' . $year . ' год';
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

    public function pdf_plan_industrial_safety($year)
    {
        $data['data'] = Plan_industrial_safety::where('year', '=', $year)->get();
        $title = 'Сведения о выполнении плана работ в области
                            промышленной
                            безопасности за ' . $year . ' год';
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

    public function pdf_kipd_internal_checks($year)
    {
        $data['data'] = KIPDInternalChecks::where('year', '=', $year)->get();
        $title = 'План корректирующих
                            действий ПБ по внутренним проверкам за ' . $year . ' год.';
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

    public function pdf_report_events($year)
    {
        $data['data'] = Report_events::where('year', '=', $year)->get();
        $title = 'Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за ' . $year . ' год.';
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

    public function pdf_events($year)
    {
        $data['data'] = Events::where('year', '=', $year)->get();
        $title = 'Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром» за ' . $year . ' год.';
        $patch = 'events' . Carbon::now() . '.pdf';
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
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_events', compact('data', 'title'))->setPaper('a4', 'landscape');
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
        if ($id_do == 'all'){
            $name_do = 'Дочернее общество. ';
        }else{
            $name_do = RefDO::where('id_do', '=', $id_do)->first()->short_name_do . '. ';
        }
        $title = $name_do.'Сведения о выполнении графика КР и ДТОиР ОПО за ' . $year . ' год.';
        $patch = 'kr_dtoip' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_kr_dtoip', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);
    }

    public function pdf_plan_of_industrial_safety($year, $id_do)
    {
        $data['data'] = Plan_of_industrial_safety::where('year', '=', $year)->where('id_do', '=', $id_do)->get();
        if ($id_do == 'all'){
            $name_do = 'Дочернее общество. ';
        }else{
            $name_do = RefDO::where('id_do', '=', $id_do)->first()->short_name_do . '. ';
        }
        $title = $name_do.'План работ в области промышленной безопасности за ' . $year . ' год';
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

    public function pdf_pat_schedule($year)
    {
        $data = Pat_schedule::where('year', '=', $year)->get();
        $title = 'График комплексных противоаварийных тренировок I - II уровня на опасных производственных объектах ООО «Газпром трансгаз Югорск» на ' . $year . ' год';
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
