<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class PdfFiles extends Model
{
    protected $table = 'reports.pdf_files';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name', 'path', 'date',
    ];

}
