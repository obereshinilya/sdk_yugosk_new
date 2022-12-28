<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Table_abbrev;
use App\Table_implications;
use App\Table_incidents;
use Illuminate\Http\Request;

class ReferenceInformationController extends Controller
{
    public function show_abbrev()
    {
        $data = Table_abbrev::all();

        return view('web.docs.referenceInformation.table_abbrev', compact('data'));
    }

    public function create_abbrev()
    {
        return view('web.docs.referenceInformation.table_abbrev_create');
    }

    public function save_abbrev(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            Table_abbrev::create($record_data);
            AdminController::log_record('Добавил запись в справочник сокращений');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_incidents()
    {


        return view('web.docs.referenceInformation.table_incidents');
    }

    public function get_incidents()
    {
        $data = Table_incidents::select('type')->groupby('type')->orderby('type')->get();
        foreach ($data as $row) {
            $data_to_table[$row->type] = Table_incidents::where('type', '=', $row->type)->get()->toArray();

        }

        return $data_to_table;
    }


    public function create_incidents()
    {
        return view('web.docs.referenceInformation.table_incidents_create');
    }

    public function save_incidents(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            Table_incidents::create($record_data);
            AdminController::log_record('Добавил запись в справочник видов аварий, инцидентов и предпоссылок к инцидентам');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_implications()
    {
        return view('web.docs.referenceInformation.table_implications');
    }

    public function show_danger_signs()
    {
        return view('web.docs.referenceInformation.table_danger_signs');
    }

    public function show_danger_classes()
    {
        return view('web.docs.referenceInformation.table_danger_classes');
    }

    public function show_type_of_hazards()
    {
        return view('web.docs.referenceInformation.table_type_of_hazards');
    }
}
