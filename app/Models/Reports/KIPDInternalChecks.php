<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class KIPDInternalChecks extends Model
{
    protected $table = 'reports.kipd_internal_checks';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = ['id_do', 'indicator', 'date_check_correct', 'person_correct', 'usloviya', 'correct_event', 'reason', 'date_check', 'person', 'name_event', 'error_comment', 'date_act',
        'num_act', 'year', 'in_use', 'podrazdelenie'
    ];
}
