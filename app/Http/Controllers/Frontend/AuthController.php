<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Customer;
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
        if (Auth::attempt($arr)) {

            $status = User::find(Auth::user()->id)->isCustomer();
        }
        return response()->json([
            'status' => $status,
            'errors' => array("username" => "", "password" => ""),
        ]);
    }

    public function getUserLogin()
    {
        $status = Auth::check();
        $user = null;
        if (Auth::check()) {
            $user = Auth::user();
        }
        return response()->json(['status' => $status, 'user' => $user]);
    }

    public function getLogout()
    {
        $status = true;
        if (Auth::check()) Auth::logout();
        return response()->json(['status' => $status]);
    }

    public function check()
    {
        dd(Auth::check());
    }

    public function postRegister(Request $req)
    {
        $validateData = Validator::make(
            $req->all(),
            [
                'username' => 'required|min:3|unique:users,username',
                'password' => 'required|min:4',
                'email' => 'required|email|unique:users,email',
            ],
            [
                'username.required' => 'Username is empty!',
                'username.min' => 'Username must be more than 2 charaters!',
                'username.unique' => 'Username is registed!',
                'password.required' => 'Password is empty!',
                'password.min' => 'Password must be more than 3 charaters!',
                'email.required' => 'Email is empty!',
                'email.email' => 'Incorrect email type!',
                'email.unique' => 'Email is registed!',
            ]
        );
        $status = false;
        if ($validateData->fails()) {
            return response()->json([
                'status' => $status,
                'errors' => $validateData->errors(),
            ]);
        }
        $status = true;
        $user = new User();
        $user->username = $req->username;
        $user->name = $req->name;
        $user->password = Hash::make($req->password);
        $user->email = $req->email;
        $user->phone_number = $req->phone;        
        $user->api_token = Str::random(60);
        $user->remember_token = Str::random(10);
        $user->save();
        $customer = new Customer();
        $customer->user_id = $user->id;
        $customer->address = $req->address;
        $customer->save();
        return response()->json([
            'status' => $status,
            'errors' => array("username" => "", "password" => "", "email" => ""),
        ]);
    }
}
