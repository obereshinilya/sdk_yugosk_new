<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class RefOpo extends Model
{
    protected $table = 'public.ref_opo';
    public $timestamps = false;
    public $primaryKey = 'id_opo';

    protected $fillable = [
        'id_do', 'type_opo', 'short_name_opo', 'full_name_opo', 'guid_opo', 'id_status', 'reg_num', 'registration_date', 'region_opo', 'hazard_class'
    ];



}
