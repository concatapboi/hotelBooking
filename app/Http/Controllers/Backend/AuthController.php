<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\HotelManagerAuth;
use Validator;
use Hash;
use Auth;
use App\Models\User;
use App\Models\HotelManager;

class AuthController extends Controller
{
    public function getLogin()
    {
    	return view('Backend.Auth.login');
    }

    public function postLogin(Request $request)
    {
    	$email = $request->email;
    	$password = $request->password;
    	$arr = [
				'email' => $email, 
				'password' => $password,
    	];
    	if(filter_var($email, FILTER_VALIDATE_EMAIL ) != false){
    		Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
    		Auth::guard('manager')->attempt(['email' => $email, 'password' => $password]);
    	}else{
    		Auth::guard('admin')->attempt(['username' => $email, 'password' => $password]);
    		Auth::guard('manager')->attempt(['username' => $email, 'password' => $password]);
    		
    	}
    	if(Auth::guard("admin")->check()){
    		return redirect()->route("adminIndex");
    	}
    	else if(Auth::guard("manager")->check()){
    		return redirect()->route("managerIndex");
    	}
    	return redirect()->route("login");
    }

    public function getRegister()
    {
    	return view('Backend.Auth.register');
    }

    public function postRegister(Request $request)
    {
    	$credential = [
    		"email" => $request->email,
    		"username" => $request->username,
    		"password" => $request->password,
    		"password_confirmation" => $request->password_confirmation,
    	];
    	$validator = Validator::make($credential, [
            'username' => 'required|unique:users|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:8',
        ]);
        if($validator->fails()){
        	return back()->withErrors($validator)->withInput();
        }
        $credential['password'] = Hash::make($request->password);
        $user = User::create($credential);
        HotelManager::create(["user_id" => $user->id]);
        Auth::login($user);
        return view('Backend.Manager.Pages.index');
    }
    public function postLogOut()
    {
    	Auth::guard("manager")->logout();
    	return redirect()->back();
    }
    public function postLogOutadmin()
    {
    	Auth::guard("admin")->logout();
    	return redirect()->back();
    }
    
}
