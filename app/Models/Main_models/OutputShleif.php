<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class OutputShleif extends Model
{
    protected $table = 'public.output_shleif';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_out','t_out', 'n', 'n_w', 'n_lim', 'time_low', 'date_end', 'left_time',
    ];



}
