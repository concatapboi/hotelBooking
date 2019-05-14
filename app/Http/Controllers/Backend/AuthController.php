<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\HotelManagerAuth;
use Validator;
use Hash;
use Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\HotelManager;

class AuthController extends Controller
{
	public function login(Request $request)
	{
		$email = $request->email;
		$password = $request->password;
		$arr = [
			'email' => $email,
			'password' => $password,
		];
		if (filter_var($email, FILTER_VALIDATE_EMAIL) != false) {
			Auth::guard('admin')->attempt(['email' => $email, 'password' => $password]);
			Auth::guard('manager')->attempt(['email' => $email, 'password' => $password]);
		} else {
			Auth::guard('admin')->attempt(['username' => $email, 'password' => $password]);
			Auth::guard('manager')->attempt(['username' => $email, 'password' => $password]);
		}
		if (Auth::guard("admin")->check()) {
			return response()->json([
				"status" => true,
				"data" => Auth::guard('admin')->user(),
				"role" => "admin",
				"messages" => "login succesfully",
			]);
		} else if (Auth::guard("manager")->check()) {
			return response()->json([
				"status" => true,
				"data" => Auth::guard('manager')->user(),
				"role" => "manager",
				"messages" => "login succesfully",
			]);
		}
		return response()->json([
			"status" => false,
			"messages" => "please check your credential again",
		]);;
	}

	public function register(Request $request)
	{
		// return response()->json([
		// 	"data" => 1,
		// ]);
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
			'password_confirmation' => 'required'
		]);
		
		if ($validator->fails()) {
			return response()->json([
				"status" => false,
				"errors" => $validator->errors(),
			]);
		}
		$credential['password'] = Hash::make($request->password);
		$credential['api_token'] = Str::random(60);
		$user = User::create($credential);
		HotelManager::create(["user_id" => $user->id]);
		return response()->json([
			"status" => true,
			"data" => User::find($user->id),
		]);
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
	public function user(Request $request)
	{
		return User::all();
	}
	public function managerLogin()
	{
		return view("Backend.ManagerLogin");
	}
}
