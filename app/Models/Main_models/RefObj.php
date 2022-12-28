<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class RefObj extends Model
{
    protected $table = 'public.ref_obj';
    public $timestamps = false;
    public $primaryKey = 'id_obj';

    protected $fillable = [
        'id_opo', 'type_obj', 'short_name_obj', 'full_name_obj', 'guid_obj', 'id_status'
    ];



}
