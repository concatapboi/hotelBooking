<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
	    return view('web')->with(['err'=>false]);
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
	    return view('web')->with(['err'=>true]);
	}
}
