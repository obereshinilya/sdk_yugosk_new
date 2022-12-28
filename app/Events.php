<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'reports.events';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name_do', 'org', 'viols', 'act_num', 'date_issue', 'events', 'person', 'date_base', 'date_repiat', 'date_fact', 'completion_mark', 'note', 'year', 'date_update'
    ];
}
