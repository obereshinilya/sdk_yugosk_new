<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conclusions_industrial_safety extends Model
{
    protected $table = 'reports.conclusions_industrial_safety';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'center_name', 'name_do', 'type_tu', 'object_name', 'workshop_name', 'n_workshop', 'name_tu', 'manufacturer', 'station_number', 'factory_num', 'pipeline_length', 'inv_tu_num', 'date_comiss', 'date_epb', 'runtime_tu', 'age_tu', 'runtime_ext_tu', 'age_ext_tu', 'runtime_epb', 'date_next_epb', 'notification', 'reg_num', 'conditions', 'completion_mark', 'conditions_concl', 'due_date', 'priority', 'concl_num', 'exp_org_name', 'year'
    ];
}
