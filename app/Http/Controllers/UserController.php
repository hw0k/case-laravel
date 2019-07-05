<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-06-29
 * Time: 오후 4:27
 */

namespace App\Http\Controllers;


use App\Interest;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController
{
    public function idCheck(Request $request, $account){
        $user = User::where('u_account', '=', $account)->firstOrFail();
        return response()->json(['status' => $user],Response::HTTP_OK);
    }
}