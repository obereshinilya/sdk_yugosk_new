<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class RefTb extends Model
{
    protected $table = 'public.ref_tb';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
        'id_tb', 'id_obj', 'type_tb', 'short_name_tb', 'full_name_tb', 'guid_tb', 'id_status'
    ];



}
