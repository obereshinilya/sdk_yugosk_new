<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class AVO extends Model
{
    protected $table = 'public.avo';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_in', 'p_out','t_in', 't_out', 'time_low', 'date_end', 'left_time',
    ];



}
