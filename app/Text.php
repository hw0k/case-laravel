<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:56
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $table = 'CASE_TEXT_TB';
    protected $primaryKey = 'qu_idx';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'qu_idx',
        'te_type',
        'me_idx'
    ];

    public function media(){
        return $this->belongsTo('App\Media', 'me_idx', 'me_idx');
    }

    public function answers(){
        return $this->hasMany('App\Text_A', 'qu_idx', 'qu_idx');
    }
}