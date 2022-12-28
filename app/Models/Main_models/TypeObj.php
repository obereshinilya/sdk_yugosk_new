<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class TypeObj extends Model
{
    protected $table = 'public.typeobj';
    public $timestamps = false;
    public $primaryKey = 'type_obj';

    protected $fillable = [
        'full_name_type', 'short_name_type',
    ];



}
