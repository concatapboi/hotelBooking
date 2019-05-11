<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
	    return view('web')->with(['err'=>false]);
	}

	public function managerIndex() {
	    dd('manager');
	}

	public function adminIndex() {
	   dd('admin');
	}

	public function redirect() {
	    return view('web')->with(['err'=>true]);
	}
	
}
