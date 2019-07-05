<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    //
    protected $table = 'USER_INTEREST_TB';
    protected $primaryKey = 'u_idx';
    public $timestamps = false;

    protected $fillable = [
        'i_idx'
    ];
}
