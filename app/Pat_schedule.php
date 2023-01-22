<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pat_schedule extends Model
{
    protected $table = 'reports.pat_schedule';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'id_do', 'reg_num_opo', 'id_opo', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'year'
    ];
}
