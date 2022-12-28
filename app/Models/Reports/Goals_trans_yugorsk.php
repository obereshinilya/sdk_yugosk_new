<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class Goals_trans_yugorsk extends Model
{
    protected $table = 'reports.goals_trans_yugorsk';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['№_pp', 'safety_goals', 'result_goal', 'data_goal', 'department', 'completion_mark', 'indicative_indicator', 'year'];
}
