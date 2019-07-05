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

    public function register(Request $request){
        $user = new User();

        $user->u_account = $request->input('account');
        $user->u_password = $request->input('password');
        $user->u_name = $request->input('name');
        $user->u_email = $request->input('email');
        $user->u_phone = $request->input('phone');
        $user->u_gender = $request->input('gender');

        $user->save();

        if(!$request->exists('interests'))
            return response()->json(['idx' => $user->u_idx], Response::HTTP_OK);

        $interests = $request->input('interests');

        foreach ($interests as $item){
            $interest = new Interest();
            $interest->u_idx = $user->u_idx;
            $interest->i_idx = $item;
            $interest->save();
        }

        return response()->json(['idx' => $user->u_idx], Response::HTTP_OK);
    }
}