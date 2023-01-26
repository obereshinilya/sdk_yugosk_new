<?php

namespace App\Models\intelligence_opo_model;

use Illuminate\Database\Eloquent\Model;

class opo_parts_norm extends Model
{
    protected $table = 'intelligence_opo.opo_parts';
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = ['id_opo_from_list', 'name_part', 'desc', 'name_thing', 'desc_tech', 'class_hazard'];
}
