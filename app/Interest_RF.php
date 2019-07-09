<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest_RF extends Model
{
    //
    protected $table = 'INTEREST_RF';
    protected $primaryKey = 'i_idx';
    public $timestamps = false;

    protected $fillable = [
        'i_interest'
    ];
}
