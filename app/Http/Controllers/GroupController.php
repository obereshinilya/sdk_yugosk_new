<?php

namespace App\Http\Controllers;

use App\Conclusions_industrial_safety;
use App\Http\Controllers\Controller;
use App\Models\Reports\ActualDeclarations;
use App\Models\Reports\Goals_trans_yugorsk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function get_group(Request $request, $table, $column)
    {
        if ($request->all()) {
            $keys = array_keys($request->all());
            foreach ($keys as $key) {
                $fieldset[$key] = explode('!!', $request[$key]);
                if (isset($data_one)) {
                    $data_one = $data_one->whereIn($key, $fieldset[$key]);
                } else {
                    switch ($table) {
                        case 'conclusions':
                            $data_one = Conclusions_industrial_safety::whereIn($key, $fieldset[$key]);
                            break;
                        case 'ref_do':
                            $data_one = DB::table('public.ref_do')->
                            join('public.typestatus', 'public.ref_do.id_status', '=', 'public.typestatus.id_status')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'actual_declarations':
                            $data_one = ActualDeclarations::whereIN($key, $fieldset[$key]);
                            break;
                        case 'report_events':
                            $data_one = DB::table('reports.report_events')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.report_events.id_do')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'events':
                            $data_one = DB::table('reports.events')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.events.id_do')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'fulfillment':
                            $data_one = DB::table('reports.fulfillment_certification')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.fulfillment_certification.id_do')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'pat_schedule':
                            $data_one = DB::table('reports.pat_schedule')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.pat_schedule.id_do')->join('public.ref_opo', 'public.ref_opo.id_opo', '=', 'reports.pat_schedule.id_opo')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'emergency_drills':
                            $data_one = DB::table('reports.emergency_drills')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.emergency_drills.id_do')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'goals_trans':
                            $data_one = Goals_trans_yugorsk::whereIN($key, $fieldset[$key]);
                            break;
                        case 'kipd_internal':
                            $data_one = DB::table('reports.kipd_internal_checks')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.kipd_internal_checks.id_do')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'perfomance_plan':
                            $data_one = DB::table('reports.perfomance_plan_KiPD')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.perfomance_plan_KiPD.id_do')->whereIN($key, $fieldset[$key]);
                            break;
                        case 'plan_industrial':
                            $data_one = DB::table('reports.plan_industrial_safety')->
                            join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.plan_industrial_safety.id_do')->whereIN($key, $fieldset[$key]);
                            break;

                    }
                }
            }

            $data_one->groupby($column)->orderby($column);
        } else {
            switch ($table) {
                case 'conclusions':
                    $data_one = Conclusions_industrial_safety::groupby($column)->orderby($column);
                    break;
                case 'ref_do':
                    $data_one = DB::table('public.ref_do')->
                    join('public.typestatus', 'public.ref_do.id_status', '=', 'public.typestatus.id_status')
                        ->groupby($column)->orderby($column);
                    break;
                case 'actual_declarations':
                    $data_one = ActualDeclarations::groupby($column)->orderby($column);
                    break;
                case 'report_events':
                    $data_one = DB::table('reports.report_events')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.report_events.id_do')->where('year', $request->year)->groupby($column)->orderby($column);
                    break;
                case 'events':
                    $data_one = DB::table('reports.events')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.events.id_do')->where('year', $request->year)->groupby($column)->orderby($column);
                    break;
                case 'fulfillment':
                    $data_one = DB::table('reports.fulfillment_certification')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.fulfillment_certification.id_do')->where('year', $request->year)->groupby($column)->orderby($column);
                    break;
                case 'pat_schedule':
                    $data_one = DB::table('reports.pat_schedule')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.pat_schedule.id_do')->join('public.ref_opo', 'public.ref_opo.id_opo', '=', 'reports.pat_schedule.id_opo')->where('year', $request->year)->groupby($column)->orderby($column);
                    break;
                case 'emergency_drills':
                    $data_one = DB::table('reports.emergency_drills')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.emergency_drills.id_do')->where('year', $request->year)->groupby($column)->orderby($column);
                    break;
                case 'goals_trans':
                    $data_one = Goals_trans_yugorsk::where('year', $request->year)->groupby($column)->orderby($column);
                    break;
                case 'kipd_internal':
                    $data_one = DB::table('reports.kipd_internal_checks')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.kipd_internal_checks.id_do')->groupby($column)->orderby($column);
                    break;
                case 'perfomance_plan':
                    $data_one = DB::table('reports.perfomance_plan_KiPD')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.perfomance_plan_KiPD.id_do')->groupby($column)->orderby($column);
                    break;
                case 'plan_industrial':
                    $data_one = DB::table('reports.plan_industrial_safety')->
                    join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.plan_industrial_safety.id_do')->groupby($column)->orderby($column);
                    break;
            }

        }
        return $data_one->get($column);
    }
}
