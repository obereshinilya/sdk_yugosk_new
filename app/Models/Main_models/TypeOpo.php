<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class TypeOpo extends Model
{
    protected $table = 'public.typeopo';
    public $timestamps = false;
    public $primaryKey = 'type_opo';

    protected $fillable = [
        'full_name_type', 'short_name_type',
    ];



}
