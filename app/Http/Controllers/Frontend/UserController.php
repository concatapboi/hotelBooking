<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Customer;
use App\Models\CustomerFollowing;
use App\Models\HotelFollowing;
use Auth;
use Validator;
use Hash;
use Session;

class UserController extends Controller
{
    //get top 5
    public function getTop5()
    {
        $user = array();
        $customer = Customer::orderBy('coin', 'desc')->take(5)->get()->toArray();
        foreach ($customer as $key => $value) {
            $user[] = User::find($value['user_id']);
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

    //
    public function show($id)
    {
        $status = false;
        $user = null;
        $customer = null;
        $userFollowing = 0;
        $hotelFollowing = 0;
        $followers = 0;
        $avatar = null;
        if (User::find($id)) {
            $user = User::find($id)->toArray();
            if (User::find($id)->isCustomer()) {
                $status = true;
                $customer = Customer::where('user_id', $id)->first()->toArray();
                $userFollowing = CustomerFollowing::where('follower_id', $id)->count();
                $followers = CustomerFollowing::where('followed_id', $id)->count();
                $hotelFollowing = HotelFollowing::where('customer_id', $id)->count();
                $avatar = UserImage::where('user_id', $id)->where('is_primary', 1)->first()->toArray();
            }
        }
        return response()->json([
            'status' => $status,
            'user' => $user,
            'customer' => $customer,
            'userFollowing' => $userFollowing,
            'hotelFollowing' => $hotelFollowing,
            'followers' => $followers,
            'avatar' => $avatar
        ]);
    }

    //put/patch user/{user}
    public function update($id, Request $req)
    {
        if (User::find($id)) {
            $user = User::find($id);
            $user->update([
                'username' => $req->username,
                'email' => $req->email,
                'name' => $req->name,
                'phone_number' => $req->phone_number,                
            ]);
                dd($user);
            $customer = Customer::where('user_id', $id)->first()->update(['address' => $req->address]);            
            return response()->json(['status' => $req->phone_number]);
        }
        return response()->json(['status' => false]);
    }
}
