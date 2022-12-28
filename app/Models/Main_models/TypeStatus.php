<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class TypeStatus extends Model
{
    protected $table = 'public.typestatus';
    public $timestamps = false;
    public $primaryKey = 'id_status';

    protected $fillable = [
        'descstatus',
    ];



}
