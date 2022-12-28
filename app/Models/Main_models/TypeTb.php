<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class TypeTb extends Model
{
    protected $table = 'public.typetb';
    public $timestamps = false;
    public $primaryKey = 'type_tb';

    protected $fillable = [
        'full_name_type', 'short_name_type', 'name_table'
    ];



}
