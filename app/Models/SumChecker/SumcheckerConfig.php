<?php

namespace App\Models\SumChecker;

use Illuminate\Database\Eloquent\Model;

class SumcheckerConfig extends Model
{
    protected $table = 'sumchecker.check_config';

    public $timestamps = false;
    protected $fillable = [
        'path'
    ];
 }

?>
