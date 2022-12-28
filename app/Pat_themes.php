<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pat_themes extends Model
{
    protected $table = 'reports.pat_themes';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'pat_desc'
    ];
}
