<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class ResultApk extends Model
{
    protected $table = 'reports.results_apk';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['id_do', 'level2_plan', 'level2_fact', 'level2_error', 'level2_error_repiat', 'level2_check', 'level2_percent', 'level3_plan', 'level3_fact', 'level3_error', 'level3_error_repiat', 'level3_check', 'level3_percent', 'level4_plan', 'level4_fact', 'level4_error', 'level4_error_repiat', 'level4_check', 'level4_percent', 'num_gaznadzor', 'gaznadzor_error', 'gaznadzor_error_repiat', 'gaznadzor_check', 'gaznadzor_check_late', 'gaznadzor_percent', 'num_rosteh', 'rosteh_error', 'rosteh_error_repiat', 'rosteh_check', 'rosteh_check_late', 'rosteh_percent', 'ind_graph', 'ind_repiat_apk', 'ind_repiat_gaznadzor', 'ind_rosteh', 'year'];

}
