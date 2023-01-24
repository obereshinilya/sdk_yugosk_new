<?php

namespace App\Models\intelligence_opo_model;

use Illuminate\Database\Eloquent\Model;

class add_info_opo extends Model
{
    protected $table = 'intelligence_opo.add_info_opo';

    public $primaryKey = 'id_add_info_opo';
    public $timestamps = false;

    protected $fillable = [
        'full_name_opo', 'type_name', 'section_number', 'address_opo', 'oktmo', 'date_commiss',
        'full_name_legal_entity', 'inn', 'chk_2_1', 'chk_2_2', 'chk_2_1_a',
        'chk_2_1_b', 'chk_2_1_v', 'chk_2_3', 'chk_2_4', 'chk_2_5', 'chk_2_6', 'chk_3_1', 'chk_3_2', 'chk_3_3', 'chk_3_4',
        'chk_4_1', 'chk_4_2', 'chk_4_3', 'chk_4_4', 'chk_4_5', 'chk_4_6', 'chk_4_7', 'chk_4_8', 'chk_4_9', 'chk_4_10',
        'chk_4_11', 'chk_4_11_a', 'chk_4_11_b', 'chk_4_11_v', 'chk_4_12', 'chk_5_1', 'chk_5_2', 'chk_5_3', 'number_pp',
        'name_sites', 'brief_description', 'name_substance', 'operational_character', 'numerical_designation',
        'full_name_le', 'applicants_address', 'head_position', 'surname_head', 'sign', 'date_signing',
        'registration_number', 'date_registration', 'date_change', 'name_rostekhnadzor', 'position_person_rostekh',
        'full_name_person_rostekh', 'sign_person_rostekh', 'date_person_rostekh'];
}
