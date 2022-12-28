<?php

namespace App\Models\Main_models;

use Illuminate\Database\Eloquent\Model;

class TagTable extends Model
{
    protected $table = 'public.buffer_table_mku_tags';
    public $timestamps = false;
    public $primaryKey = 'id_tb';

    protected $fillable = [
       'id_tb', 'tag_p_in', 'tag_p_out', 'tag_t_in', 'tag_t_out', 'status_kran', 'typetb', 'tag_for_gpa'
    ];



}
