<?php

namespace App\Http\Controllers;

use App\Conclusions_industrial_safety;
use App\Models\Main_models\RefDO;
use App\Models\Main_models\RefOpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ConclusionsController extends Controller
{
    public function show_conclusions_industrial_safety_main(Request $request)
    {
        $data_one = Conclusions_industrial_safety::orderby('id');
        $number = Conclusions_industrial_safety::orderby('id');
        $data_one = $data_one->paginate(1000);
        $i = count($number->get());
        $page = $request->page;
        if ($page == null) {
            $page = 1;
        }
        return view('web.docs.reports.conclusions_industrial_safety_main', compact('i', 'page', 'data_one'));
    }

//    public function get_group_conclusion(Request $request, $table, $column)
//    {
//        if ($request->all()) {
//            $keys = array_keys($request->all());
//            foreach ($keys as $key) {
//                $fieldset[$key] = explode(',', $request[$key]);
//                if (isset($data_one)) {
//                    $data_one = $data_one->whereIn($key, $fieldset[$key]);
//                } else {
//                    switch ($table) {
//                        case 'conclusions':
//                            $data_one = Conclusions_industrial_safety::whereIn($key, $fieldset[$key]);
//                            break;
//                        case 'ref_do':
//                            $data_one = DB::table('public.ref_do')->
//                            join('public.typestatus', 'public.ref_do.id_status', '=', 'public.typestatus.id_status')->whereIN($key, $fieldset[$key]);
//                            break;
//                    }
//                }
//            }
//            $data_one->groupby($column)->orderby($column);
//        } else {
//            switch ($table) {
//                case 'conclusions':
//                    $data_one = Conclusions_industrial_safety::groupby($column)->orderby($column);
//                    break;
//                case 'ref_do':
//                    $data_one = DB::table('public.ref_do')->
//                    join('public.typestatus', 'public.ref_do.id_status', '=', 'public.typestatus.id_status')
//                        ->groupby($column)->orderby($column);
//                    break;
//            }
//
//        }
//        return $data_one->get($column);
//    }

    public function show_conclusions_industrial_safety(Request $request)
    {
        $keys = array_keys($request->all());
        foreach ($keys as $column) {
            if ($column != '_token' && $column != 'page') {
                $fieldset[$column] = explode(',', $request[$column]);
                if (isset($data_one)) {
                    $data_one->whereIn($column, $fieldset[$column]);
                    $number->whereIn($column, $fieldset[$column]);
                } else {
                    $data_one = Conclusions_industrial_safety::orderby('id')->whereIn($column, $fieldset[$column]);
                    $number = Conclusions_industrial_safety::whereIn($column, $fieldset[$column]);
                }
            }
        }
        $data_one = $data_one->paginate(1000);
        $i = count($number->get());
        $page = $request->page;
        if ($page == null) {
            $page = 1;
        }
        return view('web.docs.reports.conclusions_industrial_safety', compact('i', 'page', 'data_one', 'fieldset'));
    }


    public function create_conclusions_industrial_safety()
    {
        $do = RefDO::orderby('short_name_do')->select('short_name_do')->get();
        return view('web.docs.reports.conclusions_industrial_safety_new', compact('do'));
    }

    public function save_conclusions_industrial_safety(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }


            Conclusions_industrial_safety::create($record_data);
            AdminController::log_record('?????????????? ???????????? ?? ???????????? ???????????????????? ???????????????????? ???????????????????????? ????????????????????????');//?????????? ?? ????????????
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_conclusions_industrial_safety($id)
    {
        Conclusions_industrial_safety::where('id', '=', $id)->first()->delete();
        AdminController::log_record('???????????? ' . $id . ' ???????????? ?? ?????????????? ???????????????????? ???????????????????? ???????????????????????? ????????????????????????');//?????????? ?? ????????????
    }

    public function edit_conclusions_industrial_safety($id)
    {
        $data = Conclusions_industrial_safety::where('id', '=', $id)->first();
        $do = RefDO::orderby('short_name_do')->select('short_name_do')->get();

        return view('web.docs.reports.conclusions_industrial_safety_edit', compact('data', 'do'));
    }

    public function update_conclusions_industrial_safety(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }


            Conclusions_industrial_safety::where('id', '=', $id)->first()->update($record_data);

            AdminController::log_record('?????????????? ' . $id . ' ???????????? ?? ?????????????? ???????????????????? ???????????????????? ???????????????????????? ????????????????????????');//?????????? ?? ????????????
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
