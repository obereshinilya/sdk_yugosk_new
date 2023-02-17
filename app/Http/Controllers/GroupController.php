<?php

namespace App\Http\Controllers;

use App\Conclusions_industrial_safety;
use App\Http\Controllers\Controller;
use App\Models\Reports\ActualDeclarations;
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
            }

        }
        return $data_one->get($column);
    }
}
