<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class KRANS extends Model
{
    protected $table = 'public.krans';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'date', 'p_1', 'p_2', 'delta_p', 'delta_p_max', 'time_low', 'date_end', 'left_time', 'indication_par', 'color_indication', 'l_kran'
    ];



}
