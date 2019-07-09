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
        return response()->json(['idx' => $user->u_idx],Response::HTTP_OK);
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

    public function login(Request $request){
        $user = User::where('u_account', '=', $request->input('account'))
            ->where('u_password', '=', $request->input('password'))
            ->firstOrFail();

        return response()->json($user, Response::HTTP_OK);
    }

    public function findId(Request $request){
        $input = $request->only(['name', 'email']);

        $user = User::where('u_name','=',$input['name'])
            ->where('u_email','=',$input['email'])
            ->firstOrFail();

        return response()->json(['account' => $user->u_account], Response::HTTP_OK);
    }

    public function findPw(Request $request){
        $input = $request->only(['account', 'email']);

        $user = User::where('u_account','=',$input['account'])
            ->where('u_email','=',$input['email'])
            ->firstOrFail();

        return response()->json(['password' => $user->u_password], Response::HTTP_OK);
    }

    public function setProfile(Request $request, $id){
        if($request->hasFile('profile')){
            $user = User::findOrFail($id);
            $profile = $request->file('profile');

            $extension = $profile->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $profile->move('uploads/profiles/', $filename);

            $user->u_profile = $filename;
            $user->save();

            return response()->json($user, Response::HTTP_OK);
        } else {
            return response()->json(['status' => 'No Profile File'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function show(Request $request, $id){
        $user = User::findOrFail($id);

        $user->u_password = null;
        return response()->json($user, Response::HTTP_OK);
    }
}