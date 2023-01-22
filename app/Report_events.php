<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_events extends Model
{
    protected $table = 'reports.report_events';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'id_do', 'num_elim', 'num_unrem', 'num_unexp_deadlines', 'num_act', 'num_repiat', 'note', 'date_update', 'year'
    ];
}
