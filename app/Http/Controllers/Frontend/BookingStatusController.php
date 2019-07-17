<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserImage;
use App\Models\Booking;
use App\Models\BookingStatus;
use Validator;
use Hash;
use Session;

class BookingStatusController extends Controller
{
    //get status
    public function index()
    {
        return response()->json([
            'data' => BookingStatus::all()
        ]);
    }

    //get status/create
    public function create()
    {
        return;
    }

    //post status
    public function store()
    {
        return;
    }

    //get status/{status}
    public function show($id)
    {
        return;
    }

    //status/{status}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch status/{status}
    public function update($id, Request $req)
    {
        return;
    }

    //delete status/{status}
    public function destroy($id)
    {
        return;
    }
}
