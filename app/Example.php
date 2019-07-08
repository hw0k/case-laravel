<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:55
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $table = 'CASE_EXAMPLE_TB';
    protected $primaryKey = 'qu_idx';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'ex_type'
    ];
}