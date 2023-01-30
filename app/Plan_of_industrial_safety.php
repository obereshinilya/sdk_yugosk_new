<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_of_industrial_safety extends Model
{
    protected $table = 'reports.plan_of_industrial_safety';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'struct_unit', 'goals', 'risk', 'event', 'cost', 'src', 'completion_date', 'person', 'completion_mark', 'year', 'id_do'
    ];
}
