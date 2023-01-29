<?php

namespace App\Http\Controllers;

use App\Conclusions_industrial_safety;
use App\Events;
use App\Fulfillment_certification;
use App\Models\Logs;
use App\Models\Main_models\AllIndicators;
use App\Models\Main_models\RefDO;
use App\Models\Main_models\RefOpo;
use App\Models\Reports\EmergencyDrills;
use App\Models\Reports\Goals_trans_yugorsk;
use App\Models\Reports\ActualDeclarations;
use App\Models\Reports\KIPDInternalChecks;
use App\Models\Reports\KR_DTOIP;
use App\Models\Reports\ResultApk;
use App\Models\Reports\Sved_avar;
use App\Models\Reports\Perfomance_plan_KiPD;
use App\Models\Reports\Plan_industrial_safety;
use App\Models\Reports\emergency_drills;
use App\Pat_schedule;
use App\Pat_themes;
use App\Plan_of_industrial_safety;
use App\Report_events;
use App\Table_incidents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Psr7\str;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        AdminController::log_record('Открыл документарный блок  ');//пишем в журнал
        return view('web.docs.reports.report_main');
    }

    //Реестр актуальных деклараций
    public function actual_declarations(Request $request)
    {
        AdminController::log_record('Открыл реестр актуальных декларация ПБ ');//пишем в журнал
        return view('web.docs.reports.report_actual_declarations');
    }

    public function create_actual_declarations()
    {
        return view('web.docs.reports.report_actual_declarations_new');
    }

    public function save_actual_declarations(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            ActualDeclarations::create($record_data);
            AdminController::log_record('Добавил запись в реестр актуальных декларация ПБ ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_actual_declarations($id)
    {
        ActualDeclarations::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в реестре актуальных декларация ПБ ');//пишем в журнал
    }

    public function edit_actual_declarations($id)
    {
        $data = ActualDeclarations::where('id', '=', $id)->first();
        return view('web.docs.reports.report_actual_declarations_edit', compact('data'));
    }

    public function update_actual_declarations(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            ActualDeclarations::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id . ' запись в реестр актуальных декларация ПБ ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function get_actual_declarations()
    {
        $data = ActualDeclarations::orderby('id')->get();
        return $data;
    }

//План корректирующих действий ПБ по внутренним проверкам
    public function kipd_internal_checks()
    {
        AdminController::log_record('Открыл план корректирующих действий ПБ по внутренним проверкам');//пишем в журнал
        return view('web.docs.reports.report_kipd_internal_checks');
    }

    public function get_kipd_internal_checks($year)
    {
        $data = KIPDInternalChecks::where('year', '=', $year)->orderbydesc('date_check')->get()->toArray();
        foreach ($data as $key => $row) {
            $data[$key]['name_do'] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
        }
        return $data;
    }

    public function remove_kipd_internal_checks($id)
    {
        KIPDInternalChecks::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в плане корректирующих действий ПБ по внутренним проверкам');//пишем в журнал
    }

    public function checked_kipd_internal_checks($id)
    {
        $record = KIPDInternalChecks::where('id', '=', $id)->first();
        if ($record->in_use) {
            $data['in_use'] = false;
        } else {
            $data['in_use'] = true;
        }
        $record->update($data);
    }

    public function create_kipd_internal_checks()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_kipd_internal_checks_new', compact('do'));
    }

    public function save_kipd_internal_checks(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (!$record_data['date_act']) {
                unset($record_data['date_act']);
            }
            if ($record_data['date_check_correct']) {
                if (strtotime($record_data['date_check_correct']) > strtotime($record_data['date_check'])) {
                    $record_data['indicator'] = 0;
                } else {
                    $record_data['indicator'] = 1;
                }
            } else {
                if (strtotime($record_data['date_check']) < strtotime(date('Y-m-d'))) {
                    $record_data['indicator'] = 0;
                } else {
                    $record_data['indicator'] = 1;
                }
                unset($record_data['date_check_correct']);
            }
            if (!$record_data['date_check']) {
                return ['1' => 'Про', '2' => 'вал'];
            } else {
                KIPDInternalChecks::create($record_data);
                AdminController::log_record('Добавил запись в план корректирующих действий ПБ по внутренним проверкам');//пишем в журнал
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function edit_kipd_internal_checks($id)
    {
        $edition_data = KIPDInternalChecks::where('id', '=', $id)->first();
        return view('web.docs.reports.report_kipd_internal_checks_edit', compact('edition_data'));
    }

    public function update_kipd_internal_checks($id, Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (!$record_data['date_act']) {
                unset($record_data['date_act']);
            }
            if ($record_data['date_check_correct']) {
                if (strtotime($record_data['date_check_correct']) > strtotime($record_data['date_check'])) {
                    $record_data['indicator'] = 0;
                } else {
                    $record_data['indicator'] = 1;
                }
            } else {
                if (strtotime($record_data['date_check']) < strtotime(date('Y-m-d'))) {
                    $record_data['indicator'] = 0;
                } else {
                    $record_data['indicator'] = 1;
                }
                unset($record_data['date_check_correct']);
            }
            if (!$record_data['date_check']) {
                return ['1' => 'Про', '2' => 'вал'];
            } else {
                KIPDInternalChecks::where('id', '=', $id)->first()->update($record_data);
                AdminController::log_record('Изменил запись в плане корректирующих действий ПБ по внутренним проверкам');//пишем в журнал
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

//Результат АПК
    public function result_apk()
    {
        AdminController::log_record('Открыл результаты АПК ');//пишем в журнал
        return view('web.docs.reports.report_result_apk');
    }

    public function get_result_apk($year)
    {
        try {
            $data = ResultApk::orderbyDesc('id')->where('year', '=', $year)->get()->toArray();
            $i = 1;
            foreach ($data as $row) {
                $keys = array_keys($row);
                list($keys[array_search('id_do', $keys)], $keys[array_search('id', $keys)]) = array($keys[array_search('id', $keys)], $keys[array_search('id_do', $keys)]);
                foreach ($keys as $key) {
                    if ($key == 'id_do') {
                        $data_to_table[$key][$i] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
                    } else {
                        $data_to_table[$key][$i] = $row[$key];
                    }
                }
                $i++;
            }
            return $data_to_table;
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_result_apk($id)
    {
        ResultApk::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в результатах АПК ');//пишем в журнал
    }

    public function edit_result_apk($id)
    {
        $data = ResultApk::where('id', '=', $id)->first();
        return view('web.docs.reports.report_result_apk_edit', compact('data'));
    }

    public function update_result_apk(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if ($record_data['level2_error']) {
                $record_data['level2_percent'] = round((((int)$record_data['level2_check'] / (int)$record_data['level2_error']) * 100), 2);
            } else {
                $record_data['level2_percent'] = 100;
            }
            if ($record_data['level3_error']) {
                $record_data['level3_percent'] = round((((int)$record_data['level3_check'] / (int)$record_data['level3_error']) * 100), 2);
            } else {
                $record_data['level3_percent'] = 100;
            }
            if ($record_data['level4_error']) {
                $record_data['level4_percent'] = round((((int)$record_data['level4_check'] / (int)$record_data['level4_error']) * 100), 2);
            } else {
                $record_data['level4_percent'] = 100;
            }
            if ($record_data['gaznadzor_error']) {
                $record_data['gaznadzor_percent'] = round((((int)$record_data['gaznadzor_check'] / (int)$record_data['gaznadzor_error']) * 100), 2);
            } else {
                $record_data['gaznadzor_percent'] = 100;
            }
            if ($record_data['rosteh_error']) {
                $record_data['rosteh_percent'] = round((((int)$record_data['rosteh_check'] / (int)$record_data['rosteh_error']) * 100), 2);
            } else {
                $record_data['rosteh_percent'] = 100;
            }
            ///Индикативные показатели
            ///   График АПК
            // Смотрим на план/факт ПК
            if ((int)$record_data['level2_plan'] <= (int)$record_data['level2_fact'] && (int)$record_data['level3_plan'] <= (int)$record_data['level3_fact'] && (int)$record_data['level4_plan'] <= (int)$record_data['level4_fact']) {
                $graph_pk = 0.3;
            } else {
                $graph_pk = 0;
            }
            $record_data['ind_graph'] = $graph_pk;
            ///   ПК
            ///Смотрим на повторы
            if ((int)$record_data['level2_error_repiat'] == 0 && (int)$record_data['level3_error_repiat'] == 0 && (int)$record_data['level4_error_repiat'] == 0) {
                $graph_pk = 0.7;
            } else {
                try {
                    $data_last_year = ResultApk::where('id_do', '=', $record_data['id_do'])->where('year', '=', (((int)$record_data['year']) - 1))->get()->toArray();
                    if ((int)$data_last_year[0]['level2_error_repiat'] >= (int)$record_data['level2_error_repiat'] && (int)$data_last_year[0]['level3_error_repiat'] >= (int)$record_data['level3_error_repiat'] && (int)$data_last_year[0]['level4_error_repiat'] >= (int)$record_data['level4_error_repiat']) {
                        $graph_pk = 0.5;
                    } else {
                        $graph_pk = 0;
                    }
                } catch (\Throwable $e) {
                    $graph_pk = 0.5;
                }
            }
            $indikator_pk = $graph_pk;
            ///   Гос надзор
            /// Смотрим на количество несоответствий
            if ((int)$record_data['rosteh_check_late'] == 0) {
                $graph_pk = 0.5;
            } else {
                $graph_pk = 0;
            }
            ///Смотрим на повторы
            if ((int)$record_data['rosteh_error_repiat'] == 0) {
                $graph_pk = $graph_pk + 0.5;
            } else {
                try {
                    $data_last_year = ResultApk::where('id_do', '=', $record_data['id_do'])->where('year', '=', (((int)$record_data['year']) - 1))->get()->toArray();
                    if ((int)$data_last_year[0]['rosteh_error_repiat'] >= (int)$record_data['rosteh_error_repiat']) {
                        $graph_pk = $graph_pk + 0.3;
                    } else {
                        $graph_pk = $graph_pk + 0;
                    }
                } catch (\Throwable $e) {
                    $graph_pk = $graph_pk + 0.5;
                }
            }
            $indikator_rosteh = $graph_pk;
            ///   Газ надзор
            /// Смотрим на количество несоответствий
            if ((int)$record_data['gaznadzor_check_late'] == 0) {
                $graph_pk = 0.5;
            } else {
                $graph_pk = 0;
            }
            ///Смотрим на повторы
            if ((int)$record_data['gaznadzor_error_repiat'] == 0) {
                $graph_pk = $graph_pk + 0.5;
            } else {
                try {
                    $data_last_year = ResultApk::where('id_do', '=', $record_data['id_do'])->where('year', '=', (((int)$record_data['year']) - 1))->get()->toArray();
                    if ((int)$data_last_year[0]['gaznadzor_error_repiat'] >= (int)$record_data['gaznadzor_error_repiat']) {
                        $graph_pk = $graph_pk + 0.3;

                    } else {
                        $graph_pk = $graph_pk + 0;
                    }
                } catch (\Throwable $e) {
                    $graph_pk = $graph_pk + 0.5;
                }
            }
            $indikator_gaznadzor = $graph_pk;
            $record_data['ind_repiat_apk'] = $indikator_pk;
            $record_data['ind_rosteh'] = $indikator_rosteh;
            $record_data['ind_repiat_gaznadzor'] = $indikator_gaznadzor;
            ResultApk::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Редактировал запись в результатах АПК');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function create_result_apk()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_result_apk_new', compact('do'));
    }

    public function save_result_apk(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (count(ResultApk::where('year', '=', $record_data['year'])->where('id_do', '=', $record_data['id_do'])->get())) {  //если запись для ДО уже есть
                return ['1' => 'Про', '2' => 'вал'];
            } else {
                if ($record_data['level2_error']) {
                    $record_data['level2_percent'] = round((((int)$record_data['level2_check'] / (int)$record_data['level2_error']) * 100), 2);
                } else {
                    $record_data['level2_percent'] = 100;
                }
                if ($record_data['level3_error']) {
                    $record_data['level3_percent'] = round((((int)$record_data['level3_check'] / (int)$record_data['level3_error']) * 100), 2);
                } else {
                    $record_data['level3_percent'] = 100;
                }
                if ($record_data['level4_error']) {
                    $record_data['level4_percent'] = round((((int)$record_data['level4_check'] / (int)$record_data['level4_error']) * 100), 2);
                } else {
                    $record_data['level4_percent'] = 100;
                }
                if ($record_data['gaznadzor_error']) {
                    $record_data['gaznadzor_percent'] = round((((int)$record_data['gaznadzor_check'] / (int)$record_data['gaznadzor_error']) * 100), 2);
                } else {
                    $record_data['gaznadzor_percent'] = 100;
                }
                if ($record_data['rosteh_error']) {
                    $record_data['rosteh_percent'] = round((((int)$record_data['rosteh_check'] / (int)$record_data['rosteh_error']) * 100), 2);
                } else {
                    $record_data['rosteh_percent'] = 100;
                }
                ///Индикативные показатели
                ///   График АПК
                ///  Смотрим на план/факт ПК
                if ((int)$record_data['level2_plan'] <= (int)$record_data['level2_fact'] && (int)$record_data['level3_plan'] <= (int)$record_data['level3_fact'] && (int)$record_data['level4_plan'] <= (int)$record_data['level4_fact']) {
                    $graph_pk = 0.3;
                } else {
                    $graph_pk = 0;
                }
                $record_data['ind_graph'] = $graph_pk;
                ///   ПК
                ///Смотрим на повторы
                if ((int)$record_data['level2_error_repiat'] == 0 && (int)$record_data['level3_error_repiat'] == 0 && (int)$record_data['level4_error_repiat'] == 0) {
                    $graph_pk = 0.7;
                } else {
                    try {
                        $data_last_year = ResultApk::where('id_do', '=', $record_data['id_do'])->where('year', '=', (((int)$record_data['year']) - 1))->get()->toArray();
                        if ((int)$data_last_year[0]['level2_error_repiat'] > (int)$record_data['level2_error_repiat'] && (int)$data_last_year[0]['level3_error_repiat'] > (int)$record_data['level3_error_repiat'] && (int)$data_last_year[0]['level4_error_repiat'] > (int)$record_data['level4_error_repiat']) {
                            $graph_pk = 0.5;
                        } else {
                            $graph_pk = 0;
                        }
                    } catch (\Throwable $e) {
                        $graph_pk = 0.5;
                    }
                }
                $indikator_pk = $graph_pk;
                ///   Гос надзор
                /// Смотрим на количество несоответствий
                if ((int)$record_data['rosteh_check_late'] == 0) {
                    $graph_pk = 0.5;
                } else {
                    $graph_pk = 0;
                }
                ///Смотрим на повторы
                if ((int)$record_data['rosteh_error_repiat'] == 0) {
                    $graph_pk = $graph_pk + 0.5;
                } else {
                    try {
                        $data_last_year = ResultApk::where('id_do', '=', $record_data['id_do'])->where('year', '=', (((int)$record_data['year']) - 1))->get()->toArray();
                        if ((int)$data_last_year[0]['rosteh_error_repiat'] >= (int)$record_data['rosteh_error_repiat']) {
                            $graph_pk = $graph_pk + 0.3;

                        } else {
                            $graph_pk = $graph_pk + 0;
                        }
                    } catch (\Throwable $e) {
                        $graph_pk = $graph_pk + 0.5;
                    }
                }
                $indikator_rosteh = $graph_pk;
                ///   Газ надзор
                /// Смотрим на количество несоответствий
                if ((int)$record_data['gaznadzor_check_late'] == 0) {
                    $graph_pk = 0.5;
                } else {
                    $graph_pk = 0;
                }
                ///Смотрим на повторы
                if ((int)$record_data['gaznadzor_error_repiat'] == 0) {
                    $graph_pk = $graph_pk + 0.5;
                } else {
                    try {
                        $data_last_year = ResultApk::where('id_do', '=', $record_data['id_do'])->where('year', '=', (((int)$record_data['year']) - 1))->get()->toArray();
                        if ((int)$data_last_year[0]['gaznadzor_error_repiat'] >= (int)$record_data['gaznadzor_error_repiat']) {
                            $graph_pk = $graph_pk + 0.3;

                        } else {
                            $graph_pk = $graph_pk + 0;
                        }
                    } catch (\Throwable $e) {
                        $graph_pk = $graph_pk + 0.5;
                    }
                }
                $indikator_gaznadzor = $graph_pk;
                $record_data['ind_repiat_apk'] = $indikator_pk;
                $record_data['ind_rosteh'] = $indikator_rosteh;
                $record_data['ind_repiat_gaznadzor'] = $indikator_gaznadzor;
//                return json_encode($record_data);
                ResultApk::create($record_data);
                AdminController::log_record('Добавил запись в результаты АПК');//пишем в журнал
            }

        } catch (\Throwable $e) {
            return $e;
        }
    }


//Сведения об аварийности на ОПО
    public function sved_avar(Request $request)
    {
        AdminController::log_record('Открыл сведения об аварийности ОПО');//пишем в журнал
        return view('web.docs.reports.report_sved_avar');
    }

    public function get_sved_avar($year, $year_end)
    {
        $data = sved_avar::where('year', '>=', $year)->where('year', '<=', $year_end)->get()->toArray();;
        foreach ($data as $key => $row) {
            $data[$key]['name_do'] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
        }
        return $data;

    }

    public function create_sved_avar()
    {
        $types = Table_incidents::select(DB::raw('CONCAT(type,\'. \',type_incident) AS types'), 'type')->get();
        $type = Table_incidents::select('type')->groupby('type')->get();
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_sved_avar_new', compact('do', 'types', 'type'));
    }

    public function save_sved_avar(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (preg_match('#посыл#', $record_data['vid_techno_sob'])) {
                $record_data['indikativn_pokazat'] = 0.5;
            } else {
                $record_data['indikativn_pokazat'] = 0;
            }

            Sved_avar::create($record_data);
            AdminController::log_record('Добавил запись в сведения об аварийности ОПО ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_sved_avar($id)
    {
        Sved_avar::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в сведениях об аварийности ОПО');//пишем в журнал
    }

    public function edit_sved_avar($id)
    {
        $data = Sved_avar::where('id', '=', $id)->first();
        $types = Table_incidents::select(DB::raw('CONCAT(type,\'. \',type_incident) AS types'))->get();
        $type = Table_incidents::select('type')->groupby('type')->get();
        return view('web.docs.reports.report_sved_avar_edit', compact('data', 'types', 'type'));
    }

    public function update_sved_avar(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (preg_match('#посыл#', $record_data['vid_techno_sob'])) {
                $record_data['indikativn_pokazat'] = 0.5;
            } else {
                $record_data['indikativn_pokazat'] = 0;
            }


            Sved_avar::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Открыл сведения об выполнении плана КиПД');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

//Выполнение плана КиПД
    public function perfomance_plan_KiPD()
    {
        AdminController::log_record('Открыл сведения об аварийности на ОПО');//пишем в журнал
        return view('web.docs.reports.report_perfomance_plan_KiPD');
    }

    public function get_perfomance_plan_KiPD($year)
    {
        $data = Perfomance_plan_KiPD::orderByDesc('id')->where('year', '=', $year)->get()->toArray();;
        foreach ($data as $key => $row) {
            $data[$key]['name_do'] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
        }
        return $data;

    }

    public function create_perfomance_plan_KiPD()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_perfomance_plan_KiPD_new', compact('do'));
    }

    public function save_perfomance_plan_KiPD(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (strtotime($record_data['deadline']) < strtotime(date('Y-m-d H:i:s'))) {
                if ($record_data['completion_mark'] == 'true') {
                    $record_data['indicative_indicat'] = 1;
                } else {
                    $record_data['indicative_indicat'] = 0;
                }
            } else {
                $record_data['indicative_indicat'] = 1;
            }
            Perfomance_plan_KiPD::create($record_data);
            AdminController::log_record('Добавил запись в сведения об выполнении плана КиПД');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_perfomance_plan_KiPD($id)
    {
        Perfomance_plan_KiPD::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в сведениях об выполнении плана КиПД');//пишем в журнал
    }

    public function edit_perfomance_plan_KiPD($id)
    {
        $do = RefDO::orderby('short_name_do')->get();
        $data = Perfomance_plan_KiPD::where('id', '=', $id)->first();
        return view('web.docs.reports.report_perfomance_plan_KiPD_edit', compact('data', 'do'));
    }

    public function update_perfomance_plan_KiPD(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (strtotime($record_data['deadline']) < strtotime(date('Y-m-d H:i:s'))) {
                if ($record_data['completion_mark'] == 'true') {
                    $record_data['indicative_indicat'] = 1;
                } else {
                    $record_data['indicative_indicat'] = 0;
                }
            } else {
                $record_data['indicative_indicat'] = 1;
            }
            Perfomance_plan_KiPD::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id . ' запись в сведениях об выполнении плана КиПД');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

//Сведения о выполнении плана работ в области промышленной безопасности
    public function plan_industrial_safety(Request $request)
    {
        AdminController::log_record('Открыл сведения о выполнении плана работ ПБ');//пишем в журнал
        return view('web.docs.reports.report_plan_industrial_safety');

    }

    public function get_plan_industrial_safety($year)
    {
        $data = Plan_industrial_safety::orderByDesc('id')->where('year', '=', $year)->get();
        foreach ($data as $key => $row) {
            $data[$key]['name_do'] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
        }
        return $data;
    }

    public function create_plan_industrial_safety()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_plan_industrial_safety_new', compact('do'));
    }

    public function save_plan_industrial_safety(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if ($record_data['completion_mark'] == 'true') {
                $ind = 1;
                $record_data['completion_mark'] = true;
            } else {
                if (strtotime($record_data['period_execution']) < strtotime(date('Y-m-d'))) {
                    $ind = 0;
                } else {
                    $ind = 1;
                }
            }
            $record_data['indicative_indicat'] = $ind;
            Plan_industrial_safety::create($record_data);
            AdminController::log_record('Добавил запись в сведения о выполнении плана работ ПБ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_plan_industrial_safety($id)
    {
        Plan_industrial_safety::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в сведениях о выполнении плана работ ПБ');//пишем в журнал
    }

    public function edit_plan_industrial_safety($id)
    {
        $data = Plan_industrial_safety::where('id', '=', $id)->first();
        return view('web.docs.reports.report_plan_industrial_safety_edit', compact('data'));
    }

    public function update_plan_industrial_safety(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if ($record_data['completion_mark'] == 'true') {
                $ind = 1;
                $record_data['completion_mark'] = true;
            } else {
                if (strtotime($record_data['period_execution']) < strtotime(date('Y-m-d'))) {
                    $ind = 0;
                } else {
                    $ind = 1;
                }
            }
            $record_data['indicative_indicat'] = $ind;
            Plan_industrial_safety::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id . ' запись в сведениях о выполнении плана работ ПБ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }


    public function goals_trans_yugorsk(Request $request)
    {
        AdminController::log_record('Открыл реестр целей в области ПБ');//пишем в журнал
        return view('web.docs.reports.report_goals_trans_yugorsk');
    }

    public function create_goals_trans_yugorsk()
    {
        return view('web.docs.reports.report_goals_trans_yugorsk_new');
    }

    public function save_goals_trans_yugorsk(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (!$record_data['completion_mark'] && strtotime("n") > strtotime($record_data['data_goal'])) {
                $record_data['indicative_indicator'] = 0;
            } else {
                $record_data['indicative_indicator'] = 1;

            }

            Goals_trans_yugorsk::create($record_data);
            AdminController::log_record('Добавил запись в реестр целей в области ПБ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_goals_trans_yugorsk($id)
    {
        Goals_trans_yugorsk::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в реестре целей в области ПБ');//пишем в журнал
    }

    public function edit_goals_trans_yugorsk($id)
    {
        $data = Goals_trans_yugorsk::where('id', '=', $id)->first();
        return view('web.docs.reports.report_goals_trans_yugorsk_edit', compact('data'));
    }

    public function update_goals_trans_yugorsk(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (!$record_data['completion_mark'] && strtotime("n") > strtotime($record_data['data_goal'])) {
                $record_data['indicative_indicator'] = 0;
            } else {
                $record_data['indicative_indicator'] = 1;

            }
            Goals_trans_yugorsk::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id . ' запись в реестр целей в области ПБ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function get_goals_trans_yugorsk($year)
    {
        $data = Goals_trans_yugorsk::where('year', '=', $year)->get();
        return $data;

    }

    public function show_report_events()
    {
        return view('web.docs.reports.report_events');
    }

    public function get_report_events_year($year)
    {
//        $data = Report_events::where('year', '=', $year)->select('name_do')->groupby('name_do')->get();
        $data = DB::table('reports.report_events')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.report_events.id_do')->get();
        foreach ($data as $row) {

            $data_to_table[$row->short_name_do] = Report_events::where('year', '=', $year)->where('id_do', '=', $row->id_do)->orderbydesc('id_do')->get()->toArray();
        }

        return $data_to_table;

    }

    public function create_report_events()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_events_new', compact('do'));
    }

    public function save_report_events(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            $record_data['date_update'] = date('Y-m-d');

            Report_events::create($record_data);
            AdminController::log_record('Добавил запись в отчет  выполнении Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_report_events($id)
    {
        Report_events::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в отчете выполнения Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»');//пишем в журнал
    }

    public function edit_report_events($id)
    {
        $do = RefDO::orderby('short_name_do')->get();

        $data = Report_events::where('id', '=', $id)->first();
        return view('web.docs.reports.report_events_edit', compact('data', 'do'));
    }

    public function update_report_events(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['date_update'] = date('Y_m_d');

            Report_events::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id . ' запись в отчете выполнения Мероприятий по устранению нарушений действующих норм и правил, выявленных
                            Ростехнадзором при эксплуатации объектов ЕСГ ПАО «Газпром»');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_events()
    {
        return view('web.docs.reports.events');
    }

    public function get_events($year)
    {
//        $data = Events::where('year', '=', $year)->select('name_do')->groupby('name_do')->get();
        $data = DB::table('reports.events')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.events.id_do')->get();
        foreach ($data as $row) {

            $data_to_table[$row->short_name_do] = Events::where('year', '=', $year)->orderbydesc('id')->where('id_do', '=', $row->id_do)->orderbydesc('id_do')->get()->toArray();
        }

        return $data_to_table;

    }

    public function create_events()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.events_new', compact('do'));
    }

    public function save_events(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            $record_data['date_update'] = date('Y-m-d');

            Events::create($record_data);
            AdminController::log_record('Добавил запись в Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром»');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_events($id)
    {
        Events::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром»');//пишем в журнал
    }

    public function edit_events($id)
    {
        $do = RefDO::orderby('short_name_do')->get();

        $data = Events::where('id', '=', $id)->first();
        return view('web.docs.reports.events_edit', compact('data', 'do'));
    }

    public function update_events(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['date_update'] = date('Y-m-d');

            Events::where('id', '=', $id)->first()->update($record_data);

            AdminController::log_record('Изменил ' . $id . ' запись в Мероприятия
                            по устранению имеющихся нарушений действующих норм и правил, выявленных
                            Северо-Уральским управлением ООО «Газпром газнадзор» при эксплуатации объектов ЕСГ ПАО
                            «Газпром»');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }


    public function emergency_drills()
    {
        AdminController::log_record('Открыл реестр сведений о противоаварийных тренировках');//пишем в журнал
        return view('web.docs.reports.report_emergency_drills');
    }

    public function create_emergency_drills()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.report_emergency_drills_new', compact('do'));
    }

    public function save_emergency_drills(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if ((int)$record_data['plan_month_PAT'] <= (int)$record_data['fact_PAT']) {
                $ind = 1;
            } else {
                $ind = 0;
            }
            if ($record_data['grade'] == 'false') {
                $ind = $ind / 2;
            } else {
                $record_data['grade'] = true;
            }
            $record_data['indicative_indicator'] = $ind;
            EmergencyDrills::create($record_data);
            AdminController::log_record('Добавил запись в реестр противоаварийных тренировок');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_emergency_drills($id)
    {
        EmergencyDrills::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в реестре противоаварийных тренировок');//пишем в журнал
    }

    public function edit_emergency_drills($id)
    {
        $data = EmergencyDrills::where('id', '=', $id)->first();
        return view('web.docs.reports.report_emergency_drills_edit', compact('data'));
    }

    public function update_emergency_drills(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if ((int)$record_data['plan_month_PAT'] <= (int)$record_data['fact_PAT']) {
                $ind = 1;
            } else {
                $ind = 0;
            }
            if ($record_data['grade'] == 'false') {
                $ind = $ind / 2;
            } else {
                $record_data['grade'] = true;
            }
            $record_data['indicative_indicator'] = $ind;
            EmergencyDrills::where('id', '=', $id)->first()->update($record_data);
            AdminController::log_record('Изменил ' . $id . ' запись в реестр противоаварийных тренировок');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function get_emergency_drills($year)
    {
//        $data = EmergencyDrills::where('year', '=', $year)->select('id_do')->groupby('id_do')->get();
        $data = DB::table('reports.emergency_drills')->
        join('public.ref_do', 'public.ref_do.id_do', '=', 'reports.emergency_drills.id_do')->get();
//      dd($data);
        foreach ($data as $row) {
            $data_to_table[$row->short_name_do] = EmergencyDrills::where('year', '=', $year)->where('id_do', '=', $row->id_do)->orderbydesc('date_PAT')->get()->toArray();
        }
//        dd($data_to_table);
        return $data_to_table;
    }

    public function open_kr_dtoip()
    {
        AdminController::log_record('Открыл сведения о КР и ДТОиР ОПО');//пишем в журнал
        return view('web.docs.reports.report_kr_dtoip');
    }

    public function save_kr_dtoip(Request $request, $year)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                if ($values[$j] !== '') {
                    $record_data[$keys[$j]] = $values[$j];
                }
            }
            $record_data['year'] = $year;
            if (count(KR_DTOIP::where('year', '=', $year)->where('num_pp', '=', $record_data['num_pp'])->get())) {
                KR_DTOIP::where('year', '=', $year)->where('num_pp', '=', $record_data['num_pp'])->first()->update($record_data);
            } else {
                KR_DTOIP::create($record_data);
            }
            return $record_data;
            AdminController::log_record('Изменил сведения о выполнении графика КР и ДТОиР ОПО за ' . $year);//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function uncheck_kr_dtoip($num_pp, $year)
    {
        $check = KR_DTOIP::where('year', '=', $year)->where('num_pp', '=', $num_pp)->first();
        if ($check->check) {
            $check->update(['check' => false]);
        } else {
            $check->update(['check' => true]);
        }
    }

    public function get_kr_dtoip($year)
    {
        try {
            $data = KR_DTOIP::where('year', '=', $year)->get();
            $data_to_table = [];
            foreach ($data as $item) {
                $data_to_table[$item->num_pp] = $item->toArray();
            }
            return $data_to_table;
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function show_pat_themes()
    {
        $data = Pat_themes::orderby('id')->get();
        return view('web.docs.reports.pat_themes', compact('data'));
    }

    public function create_pat_themes()
    {
        return view('web.docs.reports.pat_themes_new');
    }

    public function save_pat_themes(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            Pat_themes::create($record_data);
            AdminController::log_record('Добавил запись в перечень тем ПАТ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function edit_pat_themes($id)
    {
        $data = Pat_themes::where('id', '=', $id)->first();
        return view('web.docs.reports.pat_themes_edit', compact('data'));
    }

    public function update_pat_themes(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }


            Pat_themes::where('id', '=', $id)->first()->update($record_data);

            AdminController::log_record('Изменил ' . $id . ' запись в перечне тем ПАТ');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_plan_of_industrial_safety()
    {
        return view('web.docs.reports.plan_of_industrial_safety');
    }

    public function get_plan_of_industrial_safety($year)
    {
        $data = Plan_of_industrial_safety::where('year', '=', $year)->get();


        return $data;

    }

    public function create_plan_of_industrial_safety()
    {

        return view('web.docs.reports.plan_of_industrial_safety_new');
    }

    public function save_plan_of_industrial_safety(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            $record_data['date_update'] = date('Y_m_d');

            Plan_of_industrial_safety::create($record_data);
            AdminController::log_record('Добавил запись в план работ в области промышленной безопасности');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_plan_of_industrial_safety($id)
    {
        Plan_of_industrial_safety::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в планe работ в области промышленной безопасности');//пишем в журнал
    }

    public function edit_plan_of_industrial_safety($id)
    {
        $data = Plan_of_industrial_safety::where('id', '=', $id)->first();
        return view('web.docs.reports.plan_of_industrial_safety_edit', compact('data'));
    }

    public function update_plan_of_industrial_safety(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            $record_data['date_update'] = date('Y_m_d');

            Plan_of_industrial_safety::where('id', '=', $id)->first()->update($record_data);

            AdminController::log_record('Изменил ' . $id . ' запись в планe работ в области промышленной безопасности');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }



    public function show_fulfillment_certification()
    {
        return view('web.docs.reports.fulfillment_certification');
    }

    public function get_fulfillment_certification($year)
    {
        $data = Fulfillment_certification::where('year', '=', $year)->get();
        foreach ($data as $key => $row) {
            $data[$key]['name_do'] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
        }

        return $data;

    }

    public function create_fulfillment_certification()
    {
        $do = RefDO::orderby('short_name_do')->get();
        return view('web.docs.reports.fulfillment_certification_new', compact('do'));
    }

    public function save_fulfillment_certification(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (count(Fulfillment_certification::where('id_do', '=', $record_data['id_do'])->where('year', '=', $record_data['year'])->get())) {
                return ['1' => 'Про', '2' => 'вал'];
            } else {
                Fulfillment_certification::create($record_data);
            }
            AdminController::log_record('Добавил запись в выполнение плана-графика аттестации персонала в области промышленной безопасности');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_fulfillment_certification($id)
    {
        Fulfillment_certification::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в выполнение плана-графика аттестации персонала в области промышленной безопасности');//пишем в журнал
    }

    public function edit_fulfillment_certification($id)
    {
        $data = Fulfillment_certification::where('id', '=', $id)->first();
        $do = RefDO::orderby('short_name_do')->get();

        return view('web.docs.reports.fulfillment_certification_edit', compact('data', 'do'));
    }

    public function update_fulfillment_certification(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            Fulfillment_certification::where('id', '=', $id)->first()->update($record_data);

            AdminController::log_record('Изменил ' . $id . ' запись в выполнение плана-графика аттестации персонала в области промышленной безопасности');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function show_pat_schedule()
    {
        return view('web.docs.reports.pat_schedule');
    }

    public function get_pat_schedule($year)
    {

        $data = Pat_schedule::where('year', '=', $year)->get();
        foreach ($data as $key => $row) {
            $data[$key]['name_do'] = RefDO::where('id_do', '=', $row['id_do'])->value('short_name_do');
            $data[$key]['name_opo'] = RefOpo::where('id_opo', '=', $row['id_opo'])->value('full_name_opo');
        }

        return $data;

    }

    public function create_pat_schedule()
    {
        $data = Pat_themes::orderby('id')->get();
        $do = RefDO::orderby('short_name_do')->get();
        $opo = RefOpo::orderby('full_name_opo')->get();
        return view('web.docs.reports.pat_schedule_new', compact('data', 'do', 'opo'));
    }

    public function save_pat_schedule(Request $request)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }
            if (count(Pat_schedule::where('id_do', '=', $record_data['id_do'])->where('id_opo', '=', $record_data['id_opo'])->where('year', '=', $record_data['year'])->get())) {
                return ['1' => 'er', '2' => 'ror'];
            } else {
                Pat_schedule::create($record_data);
                AdminController::log_record('Добавил запись в График комплексных противоаварийных тренировок');//пишем в журнал
            }
        } catch (\Throwable $e) {
            return $e;
        }
    }

    public function remove_pat_schedule($id)
    {
        Pat_schedule::where('id', '=', $id)->first()->delete();
        AdminController::log_record('Удалил ' . $id . ' запись в График комплексных противоаварийных тренировок');//пишем в журнал
    }

    public function edit_pat_schedule($id)
    {
        $data = Pat_schedule::where('id', '=', $id)->first();
        $jan = explode(', ', Pat_schedule::where('id', '=', $id)->value('jan'));
        $feb = explode(', ', Pat_schedule::where('id', '=', $id)->value('feb'));
        $mar = explode(', ', Pat_schedule::where('id', '=', $id)->value('mar'));
        $apr = explode(', ', Pat_schedule::where('id', '=', $id)->value('apr'));
        $may = explode(', ', Pat_schedule::where('id', '=', $id)->value('jan'));
        $jun = explode(', ', Pat_schedule::where('id', '=', $id)->value('jun'));
        $jul = explode(', ', Pat_schedule::where('id', '=', $id)->value('jul'));
        $aug = explode(', ', Pat_schedule::where('id', '=', $id)->value('aug'));
        $sep = explode(', ', Pat_schedule::where('id', '=', $id)->value('sep'));
        $oct = explode(', ', Pat_schedule::where('id', '=', $id)->value('oct'));
        $nov = explode(', ', Pat_schedule::where('id', '=', $id)->value('nov'));
        $dec = explode(', ', Pat_schedule::where('id', '=', $id)->value('dec'));
        $themes = Pat_themes::orderby('id')->get();
        $do = RefDO::orderby('short_name_do')->select('short_name_do')->get();
        $opo = RefOpo::orderby('full_name_opo')->select('full_name_opo')->get();

        return view('web.docs.reports.pat_schedule_edit', compact('data', 'do', 'opo', 'themes', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'));
    }

    public function update_pat_schedule(Request $request, $id)
    {
        try {
            $keys = json_decode($request->keys);
            $values = json_decode($request->values);
            $record_data = [];
            for ($j = 0; $j < count($keys); $j++) {
                $record_data[$keys[$j]] = $values[$j];
            }

            Pat_schedule::where('id', '=', $id)->first()->update($record_data);

            AdminController::log_record('Изменил ' . $id . ' запись в График комплексных противоаварийных тренировок');//пишем в журнал
        } catch (\Throwable $e) {
            return $e;
        }
    }
}
