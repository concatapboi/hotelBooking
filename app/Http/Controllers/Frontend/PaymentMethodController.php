<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\Booking;
use Auth;
use JWTAuth;
use Validator;
use Hash;
use Session;

class PaymentMethodController extends Controller
{
    //get paymentMethod
    public function index()
    {
        $arr = PaymentMethod::all();
        return response()->json(['data' => $arr, 'status' => true]);
    }

    //get paymentMethod/create
    public function create()
    {
        return;
    }

    //post paymentMethod
    public function store()
    {
        return;
    }

    //get paymentMethod/{paymentMethod}
    public function show($id)
    { }

    //paymentMethod/{paymentMethod}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch paymentMethod/{paymentMethod}
    public function update($id)
    {
        return;
    }

    //delete paymentMethod/{paymentMethod}
    public function destroy($id)
    {
        return;
    }
}
