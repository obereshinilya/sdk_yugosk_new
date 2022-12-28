<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs_safety extends Model
{
    protected $table = 'public.logs_safety';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'num_znak', 'up_register', 'num_check', 'spec_check', 'num_error', 'time_ban', 'num_password', 'time_session', 'time_password', 'js_max', 'js_attention', 'js_warning', 'jda_max', 'jda_attention', 'jda_warning',
        ];

}
