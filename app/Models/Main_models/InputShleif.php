<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class InputShleif extends Model
{
    protected $table = 'public.input_shleif';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_in','t_in', 'n', 'n_w', 'n_lim', 'time_low', 'date_end', 'left_time',
    ];



}
