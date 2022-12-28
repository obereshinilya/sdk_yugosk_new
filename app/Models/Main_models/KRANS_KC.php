<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class KRANS_KC extends Model
{
    protected $table = 'public.krans_kc';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'date',
    ];



}
