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

class PageController extends Controller
{
    public function login()
    {
        return view('Backend::login');
    }

    public function postLogin(Request $req)
    {
      // $this->validate($req,[
      //     'password'=> 'required|min:5|max:10',
      //     'username'=> 'required|min:5'
      //
      // ],
      // [
      //     'username.required'=> 'Empty required',
      //     'username.min'=> 'Length required: username is more than 4 charaters',
      //     'password.required'=> 'Password is not matched',
      //     'password.min'=> 'Length required: password is more than 4 charaters',
      //     'password.max'=> 'Length required: username is less than 10 charaters'
      // ]);
      $arr = array('username'=>$req->username,'password'=>$req->pass);
      if(Auth::guard('admin')->attempt($arr)){
          return redirect()->route('home');
      }else if(Auth::guard('manager')->attempt($arr)){
        $id = Auth::guard('manager')->user()->id;
        if(User::find($id)->isHotelManager($id)){
          return redirect()->route('manager-home');
        }
      }
      return redirect()->back();
    }
}
