<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class CleaningGas extends Model
{
    protected $table = 'public.cleaning_gas';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'p_w', 'p_out','p_in', 'time_low', 'date_end', 'left_time',
    ];



}
