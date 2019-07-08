<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:56
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'CASE_TAG_TB';
    protected $primaryKey = ['ca_idx', 'i_idx'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'ca_idx',
        'i_idx'
    ];
}