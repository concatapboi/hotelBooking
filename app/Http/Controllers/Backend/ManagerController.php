<?php

namespace App\Modules\Backend\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\HotelManager;

class ManagerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.manager');
    }

    public function index()
    {
        return view('Backend::manager.test');
    }

    public function test()
    {
        return view('Backend::manager.test2');
    }

    public function logout()
    {
        Auth::guard('manager')->logout();
        return redirect()->route('manager-home');
    }
}
