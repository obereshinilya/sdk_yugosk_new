<?php

namespace App\Models\intelligence_opo_model;

use Illuminate\Database\Eloquent\Model;

class opo_parts extends Model
{
    protected $table = 'intelligence_opo.opo_parts';
    public $timestamps = false;
    public $primaryKey = 'id_parts';

    protected $fillable = ['id_parts', 'id_opo', 'object_list'];
}
