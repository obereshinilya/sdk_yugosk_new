<?php

namespace App\Models\intelligence_opo_model;

use Illuminate\Database\Eloquent\Model;

class opo_parts extends Model
{
    protected $table = 'intelligence_opo.type_opo';
    public $timestamps = false;
    public $primaryKey = 'id_parts';

    protected $fillable = ['id_parts', 'id_opo', 'object_list'];
}
