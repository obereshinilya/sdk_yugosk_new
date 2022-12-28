<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class LineRecirk extends Model
{
    protected $table = 'public.line_recirc';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_in', 'p_out','t_in', 't_out', 'n', 'n_w', 'n_lim', 'time_low', 'date_end', 'left_time',
    ];



}
