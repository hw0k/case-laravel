<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:55
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class QuizList extends Model
{
    protected $table = 'QUIZ_LIST_TB';
    protected $primaryKey = ['ca_idx','qu_li_sequence'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'ca_idx',
        'qu_li_sequence',
        'qu_idx'
    ];

    public function quizDetail(){
        return $this->belongsTo('App\Quiz', 'qu_idx', 'qu_idx');
    }
}