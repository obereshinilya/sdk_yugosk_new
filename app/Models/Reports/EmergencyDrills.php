<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class EmergencyDrills extends Model
{
    protected $table = 'reports.emergency_drills';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['№_pp', 'id_do', 'plan_PAT', 'fact_PAT', 'workout_theme', 'name_reg_№_OPO', 'date_PAT', '№_date_protocol_PAT', 'basis_PAT', 'grade', 'indicative_indicator', 'year', 'plan_month_PAT'];
}
