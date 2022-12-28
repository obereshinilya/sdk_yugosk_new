<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class AllIndicators extends Model
{
    protected $table = 'reports.all_indicators';
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
       'date', 'sum_ind', 'ind_goals', 'ind_kr_dtoip', 'ind_plan_industial_safety', 'ind_emergency_drills', 'ind_sved_avar', 'ind_performance_plan_kipd', 'ind_kipd_internal_checks', 'ind_gaznadzor', 'ind_rosteh', 'ind_result_apk'
    ];



}
