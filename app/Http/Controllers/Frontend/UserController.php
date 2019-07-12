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
    public function getUser(Request $req)
    {
        $user = Auth::user();
        $user->Customer;
        $avatar = UserImage::where('user_id', $user->id)->where('is_primary', 1)->first();
        $user->avatar = $avatar;
        $user->followers = $user->Followers();
        $user->customerFollowings = $user->Followings();
        $user->hotelFollowings = $user->HotelFollowings();
        $user->review = $user->reViewList();
        foreach ($user->Booking as $b) {
            $b->Status;
            $b->cancel_status = $b->Hotel()->CancelableStatus();
            $b->PaymentMethod;
            $b->Room->RoomMode;
            $b->Room->RoomType;
            $b->Room->Hotel->HotelType;
        }
        foreach ($user->Question as $q) {
            $q->Reply;
            $q->Hotel;
        }
        return response()->json([
            'user' => $user
        ]);
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
    public function getMemberCount()
    {
        $number = 0;
        $users = User::all();
        foreach ($users as $user) {
            if ($user->isCustomer()) $number++;
        }
        return response()->json(['data' => $number]);
    }

    //
    public function show($id)
    {
        // $loginUser = Auth::check();
        // $user = User::find($id);
        // $user->Customer;
        // $avatar = UserImage::where('user_id', $user->id)->where('is_primary', 1)->first();
        // $user->avatar = $avatar;
        // $user->followers = $user->Followers();
        // if (sizeOf($user->Followers()) > 0) {
        //     foreach ($user->Followers() as $f) {
        //         return response()->json([
        //             'status' => false,
        //             'user' => $loginUser,
        //         ]);
        //         if ($f->follower_id ==  Auth::user()->id) $user->follow = true;
        //         else $user->follow = false;
        //     }
        // } else $user->follow = false;
        // $user->customerFollowings = $user->Followings();
        // $user->hotelFollowings = $user->HotelFollowings();
        // if ($user->id == Auth::user()->id)
        //     return response()->json([
        //         'status' => false,
        //         'user' => $user,
        //     ]);
        // return response()->json([
        //     'status' => true,
        //     'user' => $user,
        // ]);
    }

    public function getUserInfo(Request $req)
    {
        $id = $req->id;
        $user = User::find($id);
        $user->Customer;
        $avatar = UserImage::where('user_id', $user->id)->where('is_primary', 1)->first();
        $user->avatar = $avatar;
        $followers = $user->Followers();
        $user->follow = false;
        $user->review = $user->reViewList();
        if (sizeOf($followers) > 0) {
            foreach ($followers as $f) {
                $f->isFollowing = $f->follower->isFollowed(Auth::user()->id);  
                if ($f->follower_id ==  Auth::user()->id) {
                    $user->follow = true;     
                    $f->isFollowing =null;
                }         
            }            
        }
        $user->followers = $followers;
        $customerFollowings = $user->Followings();
        if (sizeOf($customerFollowings) > 0) {
            foreach ($customerFollowings as $c) {
                $c->isFollowing = $c->followed->isFollowed(Auth::user()->id);  
                if ($c->followed_id ==  Auth::user()->id) {  
                    $c->isFollowing =null;
                }         
            }            
        }
        $user->customerFollowings = $customerFollowings;
        $user->hotelFollowings = $user->HotelFollowings();
        if ($user->id == Auth::user()->id)
            return response()->json([
                'status' => false,
                'user' => $user,
            ]);
        return response()->json([
            'status' => true,
            'user' => $user,
        ]);
    }

    //put/patch user/{user}
    public function update($id, Request $req)
    {
        if (User::find($id)) {
            $user = User::find($id);
            $user->update([
                'name' => $req->name,
                'phone_number' => $req->phone_number,
            ]);
            $customer = Customer::where('user_id', $id)->first()->update(['address' => $req->address]);
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
