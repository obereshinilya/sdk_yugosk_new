<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Jas extends Model
{
    protected $table = 'journal.jas';
    public $timestamps = false;
    public $primaryKey = 'id';

    protected $fillable = [
        'date', 'status', 'opo', 'elem_opo', 'check', 'sobitie', 'comment', 'auto_generate', 'author'
    ];



}
