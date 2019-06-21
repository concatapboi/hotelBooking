<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Customer;
use App\Models\CustomerFollowing;
use App\Models\HotelFollowing;
use App\Models\Hotel;
use Auth;
use Validator;
use Hash;
use Session;

class UserController extends Controller
{
    //get top 5
    public function getTop5(Request $req)
    {
        $user = array();
        $customer = Customer::where('user_id', '<>', $req->id)->orderBy('coin', 'desc')->take(5)->get()->toArray();
        foreach ($customer as $key => $value) {
            $tam = array();
            $tam['user'] = User::find($value['user_id']);
            $tam['avatar'] = UserImage::where('user_id', $value['user_id'])->where('is_primary', 1)->first();
            if (CustomerFollowing::where('follower_id', $req->id)->where('followed_id', $value['user_id'])->first() != null) $tam['follow'] = true;
            else $tam['follow'] = false;
            $user[] = $tam;
        }
        return response()->json(['user' => $user, 'customer' => $customer]);
    }

    //check user
    public function checkUser(Request $req)
    {
        $userArr = array();
        $userArr = User::where('id', '<>', $req->id)->get();
        $status = ['flag' => true, 'username' => false, 'email' => false];
        foreach ($userArr as $value) {
            if ($value->username == $req->username) {
                $status['flag'] = false;
                $status['username'] = true;
            }
            if ($value->email == $req->email) {
                $status['flag'] = false;
                $status['email'] = true;
            }
        }
        return response()->json(['status' => $status]);;
    }

    //check user password
    public function checkUserPassword(Request $req)
    {
        if (User::find($req->id)) {
            $user = User::find($req->id);
            if (Auth::attempt(['username' => $user->username, 'password' => $req->password])) {
                return response()->json(['mess' => true]);;
            }
        }
        return response()->json(['mess' => false]);
    }

    //check user password
    public function updateUserPassword(Request $req)
    {
        if (User::find($req->id)) {
            $user = User::find($req->id);
            if (Auth::attempt(['username' => $user->username, 'password' => $req->password])) {
                $user->update(['password' => Hash::make($req->newPassword)]);
                return response()->json(['status' => true]);
            }
        }
        return response()->json(['status' => false]);
    }

    //follow
    public function follow(Request $req)
    {
        $f = null;
        if ($req->type == 0) {
            if (User::find($req->id) && User::find($req->followed)) {
                $f = CustomerFollowing::create([
                    'follower_id' => $req->id,
                    'followed_id' => $req->followed
                ]);
            }
        } else {
            if (User::find($req->id) && Hotel::find($req->followed)) {
                $f = HotelFollowing::create([
                    'customer_id' => $req->id,
                    'hotel_id' => $req->followed
                ]);
            }
        }
        return response()->json(['data' => $f]);
    }

    //unfollow
    public function unfollow(Request $req)
    {
        $f = null;
        if ($req->type == 0) {
            if (User::find($req->id) && User::find($req->followed)) {
                $f = CustomerFollowing::where('follower_id', $req->id)->where('followed_id', $req->followed)->delete();
            }
        } else {
            if (User::find($req->id) && Hotel::find($req->followed)) {
                $f = HotelFollowing::where('customer_id', $req->id)->where('hotel_id', $req->followed)->delete();
            }
        }
        return response()->json(['data' => $f]);
    }

    //member count
    public function getMemberCount(){
        $number = 0;
        $users = User::all();
        foreach($users as $user){
            if($user->isCustomer()) $number++;
        }
        return response()->json(['data' => $number]);
    }

    //
    public function show(Request $req,$id)
    {
        $status = false;
        $user = null;
        $customer = null;
        $userFollowing = array();
        $hotelFollowing = array();
        $followers = array();
        $avatar = null;
        $follow = false;
        if (User::find($id)) {
            $user = User::find($id)->toArray();
            if (User::find($id)->isCustomer()) {
                $status = true;
                $customer = Customer::where('user_id', $id)->first()->toArray();
                $userFollowing['count'] = CustomerFollowing::where('follower_id', $id)->count();
                foreach(CustomerFollowing::where('follower_id', $id)->get() as $key => $value){
                    $tam = array();
                    $tam['user'] = User::find($value->followed_id);
                    $tam['avatar'] = UserImage::where('user_id', $value->followed_id)->where('is_primary', 1)->first();
                    $userFollowing['users'][]= $tam;
                }
                $followers['count'] = CustomerFollowing::where('followed_id', $id)->count();
                foreach(CustomerFollowing::where('followed_id', $id)->get() as $key => $value){
                    $tam = array();
                    $tam['user'] = User::find($value->follower_id);
                    $tam['avatar'] = UserImage::where('user_id', $value->follower_id)->where('is_primary', 1)->first();
                    $followers['users'][]= $tam;
                }
                $hotelFollowing['count'] = HotelFollowing::where('customer_id', $id)->count();
                $avatar = UserImage::where('user_id', $id)->where('is_primary', 1)->first()->toArray();
                if($req->user){
                    if (CustomerFollowing::where('follower_id', $req->user)->where('followed_id', $id)->first() != null) $follow = true;            
                }
            }
        }
        return response()->json([
            'status' => $status,
            'user' => $user,
            'customer' => $customer,
            'userFollowing' => $userFollowing,
            'hotelFollowing' => $hotelFollowing,
            'followers' => $followers,
            'avatar' => $avatar,
            'follow' => $follow
        ]);
    }

    //put/patch user/{user}
    public function update($id, Request $req)
    {
        if (User::find($id)) {
            $user = User::find($id);
            $user->update([
                'email' => $req->email,
                'name' => $req->name,
                'phone_number' => $req->phone_number,
            ]);
            $customer = Customer::where('user_id', $id)->first()->update(['address' => $req->address]);
            return response()->json(['status' => $req->phone_number]);
        }
        return response()->json(['status' => false]);
    }
}
