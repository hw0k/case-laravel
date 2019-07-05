<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //

    protected $table = 'USER_TB';
    protected $primaryKey = 'u_idx';
    public $timestamps = false;

    protected $fillable = [
        'u_name',
        'u_account',
        'u_password',
        'u_age',
        'u_email',
        'u_phone',
        'u_gender',
        'u_profile'
    ];
}
