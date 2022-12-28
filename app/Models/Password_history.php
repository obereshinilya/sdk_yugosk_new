<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Password_history extends Model
{
    protected $table = 'public.password_history';

    public $primaryKey = 'id_pass';
    public $timestamps = false;


    protected $fillable = [
        'id_user', 'password',
        ];

}
