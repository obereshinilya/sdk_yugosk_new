<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class KR_DTOIP extends Model
{
    protected $table = 'reports.kr_dtoip';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name_event', 'date', 'plan_year', 'plan_month', 'fact', 'indicator', 'year', 'num_pp', 'check', 'id_do'
        ];

}
