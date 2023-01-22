<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class Plan_industrial_safety extends Model
{
    protected $table = 'reports.plan_industrial_safety';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['id_do', 'goals_OT_PB', 'name_risk', 'events', 'period_execution', 'responsible', 'completion_mark', 'indicative_indicat', 'year'];
}
