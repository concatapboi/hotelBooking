<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\Hotel;
use App\Http\Resources\BookingResource;
use Carbon\Carbon;
use Mail;
use App\Mail\AcceptOrderOnline;
use App\Mail\AcceptOrderOffline;
use App\Models\Customer;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $today = 0;
    public function __construct()
    {
        $this->today = Carbon::now();
    }
    public function index()
    {
        $bookings = Booking::all();
        $data = [];
        foreach ($bookings as $booking) {
            $data[] = $booking;
        }
        return response()->json([
            "status" => true,
            "data" => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getBookingWithHotelId(Request $request)
    {
        $hotel = Hotel::find($request->hotelId);
        return response()->json([
            "status" => true,
            "booking" => $hotel->Booking(),
        ]);
    }
    public function acceptBooking(Request $request)
    {
        $booking = Booking::find($request->bookingId);
        $room = Room::find($booking->room_id);
        $room_image = RoomImage::where("room_id",$room->id)->where("is_primary",1)->first();
        $customer = Customer::find($booking->customer_id)->ofUser;
        return (new AcceptOrderOffline($booking,$room,$room_image))->render(); 
        // if ($booking->PaymentMethod->id == 1) {
        //     $booking->update(["status_id" => 4]);
        //     Mail::to($request->user())->queue(new AcceptOrderOffline($booking));
        // } elseif ($booking->PaymentMethod->id == 2) {
        //     $booking->update(["status_id" => 2]);
        //     Mail::to($request->user())->queue(new AcceptOrderOnline($booking));
        // }
        // return response()->json([
        //     "status" => true,
        //     // "data" => new BookingResource($booking),
        //     "data" => $booking->Hotel()->booking(),
        // ]);
    }
    public function declineBooking(Request $request)
    {
        $booking = Booking::find($request->bookingId);
        $booking->update(["status_id" => 3]);
        return response()->json([
            "status" => true,
            // "data" => new BookingResource($booking),
            "data" => $booking->Hotel()->booking(),
        ]);
    }
    public function confirmBooking(Request $request)
    {
        $booking = Booking::find($request->bookingId);
        $booking->update(["status_id" => 4]);
        return response()->json([
            "status" => true,
            // "data" => new BookingResource($booking),
            "data" => $booking->Hotel()->booking(),
        ]);
    }
    public function cancelBooking(Request $request)
    {
        $booking = Booking::find($request->bookingId);
        $totalPrice = $booking->room_price * $booking->room_amount; 
        if($booking->payment_method_id == 1){
            $percent = 20;      
        }else if ($booking->payment_method_id == 2){
            $percent = 40;   
        }
        $amount = $totalPrice * $percent /100;
        $booking->Hotel()->update(["coin"=>$booking->Hotel()->coin - $amount]);
        $customer = $booking->Customer;
        $customer->update(["coin"=> $customer->coin + $amount]);
        $booking->update(["status_id" => 6]);
        return response()->json([
            "status" => true,
            // "data" => new BookingResource($booking),
            "data" => $booking->Hotel()->booking(),
        ]);
    }
    public function filterById(Request $request)
    {
        $bookingIds = explode(",",$request->bookingIds);
        $result = [];
        $hotel = Hotel::find($request->hotelId)->BookingList($request->hotelId);
        foreach($hotel as $h){
            foreach($h->room as $room){
                foreach($room->booking as $booking){
                    // return $booking;
                    if(in_array($booking->id , $bookingIds)){
                        $result[] = new BookingResource($booking);
                    }
                }
            }
        }
        return response()->json([
            "status" => true,
            "data" => $result,
        ]);
        

    }
    public function filterByDate(Request $request)
    {
        $checkin = new Carbon($request->checkin);
        $checkout = new Carbon($request->checkout);
        $result = [];
        $hotel = Hotel::find($request->hotelId)->BookingList($request->hotelId);
        foreach($hotel as $h){
            foreach($h->room as $room){
                foreach($room->booking as $booking){
                    $bookingCheckin = new Carbon($booking->check_in);
                    $bookingCheckout = new Carbon($booking->check_out);
                    if($bookingCheckin->greaterThanOrEqualTo($checkin)){
                        if($bookingCheckout->lessThanOrEqualTo($checkout)){
                            $result[] = new BookingResource($booking);
                        }
                    }
                }
            }
        }
        return response()->json([
            "status" => true,
            "data" => $result,
        ]);
    }
}
