<?php
namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PageController extends Controller{

  public function index(){
    return view('Frontend.home');
  }

  // public function about(){
  //   return view('Frontend::about');
  // }
  // public function contact(){
  //   return view('Frontend::contact');
  // }

  // public function blog(){
  //   return view('Frontend::blog');
  // }

  // public function singleBlog(){
  //   return view('Frontend::single-blog');
  // }
  // public function allHotels(){
  //   return view('Frontend::hotels');
  // }

  // public function hotelInfo(){
  //   return view('Frontend::hotel-info');
  // }

  // public function register(){
  //   return view('Frontend::register');
  // }

  // public function postLogin(Request $req){
  //   $arr = array('username'=>$req->username,'password'=>$req->password);
  //   if(Auth::attempt($arr)){
  //       return redirect()->route('customer');
  //   }
  //   return redirect()->back();
  // }

  // public function alert(Request $req){
  //   return redirect()->action('PageController@index');
  // }

}
