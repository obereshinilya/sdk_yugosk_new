<?php

namespace App\Models\Reports;

use Illuminate\Database\Eloquent\Model;

class ActualDeclarations extends Model
{
    protected $table = 'reports.actual_declarations';

    public $primaryKey = 'id';
    public $timestamps = false;


    protected $fillable = [
        'name_DPB', 'parts_DPB', 'reg_num_dpb', 'name_zepb', 'reg_num_date_zepb', 'massage_rtn', 'year'
        ];

}
