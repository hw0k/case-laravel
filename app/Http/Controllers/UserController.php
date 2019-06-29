<?php
/**
 * Created by PhpStorm.
 * User: Jin
 * Date: 2019-06-29
 * Time: 오후 4:27
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UserController
{
    private $request = null;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function idCheck($id){
        $userModel = new User();
        $userModel->setAccount($id);

        return response()->json(['status' => $userModel->idCheck()],Response::HTTP_OK);
    }
}