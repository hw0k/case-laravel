<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:39
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'QUIZ_TB';
    protected $primaryKey = 'qu_idx';
    public $timestamps = false;

    protected $fillable = [
        'qu_question',
        'qu_rAnswer',
        'qu_table'
    ];

    public function quizExample(){
        return $this->hasOne('App\Example', 'qu_idx', 'qu_idx');
    }

    public function quizText(){
        return $this->hasOne('App\Text', 'qu_idx', 'qu_idx');
    }
}