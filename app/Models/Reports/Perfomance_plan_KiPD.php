<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class Perfomance_plan_KiPD extends Model
{
    protected $table = 'reports.perfomance_plan_KiPD';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['№_pp', 'correct_action', 'respons_executor', 'deadline', 'completion_mark', 'indicative_indicat', 'year', 'id_do'];
}
