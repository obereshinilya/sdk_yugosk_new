<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_abbrev extends Model
{
    protected $table = 'direct.table_abbrev';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name', 'comment'
    ];

}
