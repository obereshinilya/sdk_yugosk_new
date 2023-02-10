<?php

namespace App\Models\intelligence_opo_model;

use Illuminate\Database\Eloquent\Model;

class opo_parts_norm extends Model
{
    protected $table = 'intelligence_opo.opo_parts';
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = ['id_opo_from_list', 'name_part', 'desc', 'st_num', 'zav_num', 'reg_num', 'inv_num',
        'name_dangerous_subst', 'dn', 'pn', 'l', 'v', 'n', 'q', 'pn_in', 'pn_out', 'capacity', 'name_tu', 'pn_gas',
        'pn_water', 'therm', 't_max', 'fuel_consump', 'year_commis', 'count_dangerous_subst', 'signs_danger', 'year_manufacture'];
}
