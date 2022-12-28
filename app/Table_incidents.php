<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table_incidents extends Model
{
    protected $table = 'direct.table_incidents';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'type', 'type_incident'
    ];
}
