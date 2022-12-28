<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class GPA extends Model
{
    protected $table = 'public.gpa';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_in', 'p_out','t_in', 't_out', 'koef', 'time_low', 'date_end', 'left_time',
    ];



}
