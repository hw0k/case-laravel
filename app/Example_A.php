<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Example_A extends Model
{
    //
    protected $table = 'CASE_EXAMPLE_A_TB';
    protected $primaryKey = 'ex_a_idx';
    public $timestamps = false;

    protected $fillable = [
        'qu_idx',
        'u_idx',
        'ex_a_answer',
    ];
}
