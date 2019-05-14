<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Hash;
use Session;

class AuthController extends Controller
{

    public function postLogin(Request $req)
    {

        $validateData = Validator::make(
            $req->all(),
            [
                'username' => 'required|min:3',
                'password' => 'required|min:4'
            ],
            [
                'username.required' => 'Username is empty!',
                'username.min' => 'Username must be more than 2 charaters!',
                'password.required' => 'Password is empty!',
                'password.min' => 'Password must be more than 3 charaters!'
            ]
        );

        $status = false;
        if ($validateData->fails()) {
            return response()->json([
                'status' => $status,
                'errors' => $validateData->errors(),
            ]);
        }
        
        $arr = array('username' => $req->username, 'password' => $req->password);
        if (Auth::attempt($arr)) 
            $status = User::find(Auth::user()->id)->isCustomer();
        return response()->json([
            'status' => $status,
            'errors' => array("username" => "","password" => "")
        ]);
    }
}
