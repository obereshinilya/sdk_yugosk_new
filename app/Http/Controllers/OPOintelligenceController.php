<?php

namespace App\Http\Controllers;

use App\Models\intelligence_opo_model\add_info_opo;
use App\Models\Main_models\RefDO;
use App\Models\intelligence_opo_model\opo;
use App\Models\Main_models\RefOpo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class OPOintelligenceController extends Controller
{
    public function opo(Request $request)
    {
        $opoint = add_info_opo::all();
        AdminController::log_record('Открыл сведения, характеризующие ОПО  ');//пишем в журнал
        return view('web.docs.intelligence_opo.opo', compact('opoint'));
    }

    public function edit_intelligence($add_info_opo)
    {
        $data = add_info_opo::where('id_add_info_opo', '=', $add_info_opo)->first();
        return view('web.docs.intelligence_opo.edit_intelligence_opo', compact('data'));
    }

    public function create_intelligence (Request $request)
    {
        return view('web.docs.intelligence_opo.create_intelligence_opo');
    }

    public function save_add_composition_opo(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['type_name'] = 3;
            add_info_opo::create($record_data);
            AdminController::log_record('Добавил запись в сведения, характеризующие ОПО');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function update_intelligence_opo(Request $request, $id_add_info_opo)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            add_info_opo::where('id_add_info_opo', '=', $id_add_info_opo)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id_add_info_opo . ' ОПО ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_intelligence_opo($id_add_info_opo)
    {
        $data = add_info_opo::where('id_add_info_opo', '=', $id_add_info_opo)->first();
        return view('web.docs.intelligence_opo.show_intelligence_opo', compact('data'));
    }

}
