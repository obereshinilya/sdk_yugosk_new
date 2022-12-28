<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fulfillment_certification extends Model
{
    protected $table = 'reports.fulfillment_certification';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name_do', 'rostech_cec', 'rostech_cec_plan', 'rostech_cec_fact', 'skills_up_cec_plan', 'skills_up_cec_fact', 'rostech_adm_do', 'rostech_adm_do_plan', 'rostech_adm_do_fact', 'is_ept_adm_do', 'is_ept_adm_do_plan', 'is_ept_adm_do_fact', 'ot_adm_do_plan', 'ot_adm_do_fact', 'pb_ec', 'pb_ec_plan', 'pb_ec_fact', 'skills_up_ec_plan', 'skills_up_ec_fact', 'rostech_do', 'rostech_do_plan', 'rostech_do_fact', 'is_ept_do', 'is_ept_do_plan', 'is_ept_do_fact', 'pb_do_plan', 'pb_do_fact', 'year'
    ];
}
