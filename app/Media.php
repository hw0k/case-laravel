<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:56
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $table = 'MEDIA_TB';
    protected $primaryKey = 'me_idx';
    public $timestamps = false;

    protected $fillable = [
        'me_path'
    ];
}