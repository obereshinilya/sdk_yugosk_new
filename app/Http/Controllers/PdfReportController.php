<?php

namespace App\Http\Controllers;

use App\Events;
use App\Jas;
use App\Models\APK_SDK;
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

    public function pdf_actual_declarations($year)
    {
        $data = ActualDeclarations::where('year', '=', $year)->get();
        $title = 'Реестр актуальных деклараций промышленной безопасности опасных производственных объектов ' . $year . 'год';
        $patch = 'actual_declarations' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_actual_declarations', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_emergency_drills($year)
    {
        $data = EmergencyDrills::where('year', '=', $year)->orderbyDesc('name_branch')->orderbydesc('date_PAT')->get();
        $title = 'Сведения о
                            противоаварийных тренировках, проведенных на
                            опасных производственных объектах в ' . $year . ' году';
        $patch = 'emergency_drills' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_emergency_drills', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_goals_trans_yugorsk($year)
    {
        $data = Goals_trans_yugorsk::where('year', '=', $year)->get();
        $title = 'Цели ООО «Газпром
                            трансгаз Югорск» в области
                            производственной безопасности на ' . $year . ' год';
        $patch = 'goals_trans_yugorsk' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_goals_trans_yugorsk', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_perfomance_plan_KiPD($year)
    {
        $data = Perfomance_plan_KiPD::where('year', '=', $year)->get();
        $title = 'Выполнение плана КиПД, утвержденного по результатам анализа ЕСУПБ в ПАО «Газпром» за ' . $year . ' год';
        $patch = 'perfomance_plan_KiPD' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_perfomance_plan_KiPD', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_plan_industrial_safety($year)
    {
        $data = Plan_industrial_safety::where('year', '=', $year)->get();
        $title = 'Сведения о выполнении плана работ в области
                            промышленной
                            безопасности за ' . $year . ' год';
        $patch = 'plan_industrial_safety' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_plan_industrial_safety', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_kipd_internal_checks($year)
    {
        $data = KIPDInternalChecks::where('year', '=', $year)->get();
        $title = 'План корректирующих
                            действий ПБ по внутренним проверкам за ' . $year . ' год.';
        $patch = 'kipd_internal_checks' . Carbon::now() . '.pdf';
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

    public function pdf_sved_avar($year)
    {
        $data = Sved_avar::where('year', '=', $year)->get();
        $title = 'Сведения об аварийности на опасных производственных объектах дочернего общества за ' . $year . ' год.';
        $patch = 'sved_avar' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_sved_avar', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_report_events($year)
    {
        $data = Report_events::where('year', '=', $year)->get();
        $title = 'Отчет
                            о выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром» за ' . $year . ' год.';
        $patch = 'report_events' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_report_events', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_events($year)
    {
        $data = Events::where('year', '=', $year)->get();
        $title = 'Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром» за ' . $year . ' год.';
        $patch = 'events' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_events', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);

    }

    public function pdf_kr_dtoip($year)
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
            $data[$row->num_pp]['date'] = $row->date;
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
//        dd($data);
        $title = 'Сведения о выполнении графика КР и ДТОиР ОПО за ' . $year . ' год.';
        $patch = 'kr_dtoip' . Carbon::now() . '.pdf';
        $pdf = PDF::loadView('web.docs.reports.pdf_form.pdf_kr_dtoip', compact('data', 'title'))->setPaper('a4', 'landscape');
        return $pdf->download($patch);
    }

    public function pdf_plan_of_industrial_safety($year)
    {
        $data = Plan_of_industrial_safety::where('year', '=', $year)->get();
        $title = 'План работ в области промышленной безопасности за ' . $year . ' год';
        $patch = 'plan_of_industrial_safety' . Carbon::now() . '.pdf';
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
}
