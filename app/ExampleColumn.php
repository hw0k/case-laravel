<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-07-08
 * Time: 오전 11:56
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ExampleColumn extends Model
{
    protected $table = 'CASE_EXAMPLE_COLUMN_TB';
    protected $primaryKey = 'ex_co_idx';
    public $timestamps = false;

    protected $fillable = [
        'qu_idx',
        'ex_co_ex',
        'ex_co_number',
        'me_idx'
    ];

    public function media(){
        return $this->hasOne('App\Media', 'me_idx', 'me_idx');
    }
}