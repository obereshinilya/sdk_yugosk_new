<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class BPTPG extends Model
{
    protected $table = 'public.bptpg';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_in', 'p_tg','p_pg', 'ig', 'time_low', 'date_end', 'left_time',
    ];



}
