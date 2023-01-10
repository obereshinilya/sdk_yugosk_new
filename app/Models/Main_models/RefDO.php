<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class RefDO extends Model
{
    protected $table = 'public.ref_do';
    public $timestamps = false;
    public $primaryKey = 'id_do';

    protected $fillable = [
        'short_name_do', 'full_name_do', 'guid_do', 'id_status',  'region', 'name_manager', 'phone_manager', 'mail_manager', 'name_chief_engineer', 'phone_chief_engineer', 'mail_chief_engineer', 'name_otpb_engineer', 'phone_otpb_engineer', 'mail_otpb_engineer', 'name_pb_engineer', 'phone_pb_engineer', 'mail_pb_engineer', 'name_ot_engineer', 'phone_ot_engineer', 'mail_ot_engineer'
    ];



}
