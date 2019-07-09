<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:45
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $table = 'CASE_TB';
    protected $primaryKey = 'ca_idx';
    public $timestamps = ['created_at'];
    const CREATED_AT = 'ca_created';

    protected $fillable = [
        'ca_title',
        'ca_content',
        'u_idx',
        'ca_point',
        'ca_participant'
    ];

    public function setUpdatedAt($value)
    {
        return $this;
    }

    public function tags(){
        return $this->hasMany('App\Tag', 'ca_idx', 'ca_idx');
    }

    public function user(){
        return $this->belongsTo('App\User', 'u_idx','u_idx');
    }
}