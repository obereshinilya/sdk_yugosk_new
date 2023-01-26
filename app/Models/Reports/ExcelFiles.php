<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class ExcelFiles extends Model
{
    protected $table = 'reports.excel_files';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name', 'comment', 'date',
    ];

}
