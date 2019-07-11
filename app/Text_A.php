<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text_A extends Model
{
    //
    protected $table = 'CASE_TEXT_A_TB';
    protected $primaryKey = 'te_a_idx';
    public $timestamps = false;

    protected $fillable = [
        'qu_idx',
        'u_idx',
        'te_a_answer',
    ];
}
