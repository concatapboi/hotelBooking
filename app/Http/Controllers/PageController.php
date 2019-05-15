<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class PageController extends Controller
{
    public function index() {
	    return view('web',compact('user'));
	}
	public function adminIndex()
	{
		return view('backend.admin');
	}
	public function managerIndex()
	{
		return view('backend.manager');
	}
	public function redirect() {
	    return redirect('/');
	}
}
