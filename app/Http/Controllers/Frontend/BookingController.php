<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Auth;
use JWTAuth;
use Validator;
use Hash;
use Session;

class BookingController extends Controller
{
    //get booking
    public function index()
    { }

    //get booking/create
    public function create()
    {
        return;
    }

    //post booking
    public function store(Request $req)
    {
        $status = false;
        $mess = "";
        $booking = null;
        $b = $req->booking;
        // return $b['email'];
        $validateData = Validator::make(
            $b,
            [
                'payment' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
                'address' => 'required',
            ]
        );
        if (!$validateData->fails()) {
            $room = Room::find($b['roomId']);
            if (!$room || $room->amount < $b['roomAmount']) $status = false;
            else {
                $status = true;
                $mess = 'Sucessfully!';
                $booking = Booking::create([
                    'hotel_name' => $room->Hotel->name,
                    'room_price' => $room->price,
                    'room_amount' => $b['roomAmount'],
                    'contact_name' => $b['name'],
                    'contact_email' => $b['email'],
                    'contact_phone' => $b['phone'],
                    'contact_address' => $b['address'],
                    'special_request' => $b['request'],
                    'fax_number' => $room->Hotel->fax_number,
                    'check_in' => $b['checkIn'],
                    'check_out' => $b['checkOut'],
                    'room_id' => $b['roomId'],
                    'customer_id' => Auth::user()->id,
                    'payment_method_id' => $b['payment'],
                    'status_id' => 1,
                ]);
                $booking->Status;
                $booking->PaymentMethod;
                $booking->Room->RoomMode;
                $booking->Room->RoomType;
            }
        } else return response()->json(['status' => $status, 'mess' => $validateData->errors()]);
        return response()->json(['status' => $status, 'mess' => $mess, 'booking' =>$booking]);
    }

    //get booking/{booking}
    public function show($id)
    { }

    //booking/{booking}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch booking/{booking}
    public function update(Request $req,$id)
    {
        $status = false;
        $b = Booking::find($id);
        if($b!=null){
            if($req->action == "cancel"){
                if($b->Status->id <3){
                    $b->update(['status_id' => 5]);
                    $status = true;
                }
            }
        }
        return response()->json(['status' =>$status]);
    }

    //delete booking/{booking}
    public function destroy($id)
    {
        return;
    }
}
