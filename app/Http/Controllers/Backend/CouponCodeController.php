<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CouponCode;
use App\Models\Hotel;
use Validator;
use App\Models\RoomType;
use Hash;
use Carbon\Carbon;
use Auth;

class CouponCodeController extends Controller
{
    //get code
    public function index(Request $req)
    {
        $hotel = Hotel::find($req->hotelId);
        $couponCode = array();
        $expiredCouponCode = array();
        if ($hotel == null)
            return response()->json([
                'status' => false,
                'couponCode' => $couponCode,
                'expiredCouponCode' => $expiredCouponCode,
            ]);        
        return response()->json([
            'status' => true,
            'couponCode' => $couponCode,
            'expiredCouponCode' => $expiredCouponCode,
        ]);
    }

    //get code/create
    public function create()
    {
        return;
    }

    //post code
    public function store()
    {
        return;
    }

    //get code/{code}
    public function show($id)
    {
        return;
    }

    //code/{code}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch code/{code}
    public function update($id, Request $req)
    {
        return;
    }

    //delete code/{code}
    public function destroy($id)
    {
        return;
    }
}
