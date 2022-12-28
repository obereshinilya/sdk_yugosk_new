<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pat_schedule extends Model
{
    protected $table = 'reports.pat_schedule';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name_filial', 'reg_num_opo', 'opo_name', 'jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec', 'year'
    ];
}
