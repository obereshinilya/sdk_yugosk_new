<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class Sved_avar extends Model
{
    protected $table = 'reports.sved_avar';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'nomer_pp', 'id_do', 'vid_techno_sob', 'mesto_techno_sob', 'data_time', 'vid_avari', 'kratk_opisan', 'nalich_postradav', 'econom_usherb', 'prodolgit_prost', 'litsa_otvetstven', 'meropriytia', 'otmetka_vypoln', 'indikativn_pokazat', 'year'
    ];

}
