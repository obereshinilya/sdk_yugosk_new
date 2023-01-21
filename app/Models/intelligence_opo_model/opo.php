<?php

namespace App\Models\intelligence_opo_model;

use Illuminate\Database\Eloquent\Model;

class opo extends Model
{
    protected $table = 'intelligence_opo.opo';
    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'id_opo', 'name_opo', 'type_name', 'digital_name', 'address_opo', 'classifier_code', 'date', 'full_name', 'inn'];
}
