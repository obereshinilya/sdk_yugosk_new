<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class MKU extends Model
{
    protected $table = 'public.mku';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'date', 'p_project', 'delta_p', 'p_in', 'p_out', 'p_low', 'time_low', 'v_p', 'v_p_km', 't_in', 't_out', 'date_end', 'left_time', 'indication_par', 'color_indication', 'l_in', 'l_out', 'lamda'
    ];



}
