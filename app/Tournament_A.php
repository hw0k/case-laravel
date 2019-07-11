<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tournament_A extends Model
{
    //
    protected $table = 'CASE_TOURNAMENT_A_TB';
    protected $primaryKey = 'ex_co_idx';
    public $timestamps = false;

    protected $fillable = [
        'ex_co_idx',
        'u_idx',
        'to_a_round',
    ];

    public function column(){
        return $this->belongsTo('App\ExampleColumn', 'ex_co_idx', 'ex_co_idx');
    }
}
