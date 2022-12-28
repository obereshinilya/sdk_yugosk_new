<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class RefDO extends Model
{
    protected $table = 'public.ref_do';
    public $timestamps = false;
    public $primaryKey = 'id_do';

    protected $fillable = [
        'short_name_do', 'full_name_do', 'guid_do', 'id_status',
    ];



}
