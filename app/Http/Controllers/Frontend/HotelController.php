<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\HotelFollowing;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\RoomMode;
use App\Models\RoomBedType;
use App\Models\BedType;
use App\Models\Feature;
use App\Models\ServiceRoomType;
use App\Models\Service;

class HotelController extends Controller
{
    //get hotels
    public function index()
    {
        $status = false;
        $hotels = Hotel::all();
        if ($hotels->count()>0) {
            $status = true;
            foreach ($hotels as $h) {
                $h->Address;
                $h->maxPrice=$h->maxPrice();
                $h->minPrice=$h->minPrice();
            }
        }
        return response()->json(['status' => $status, 'data' => $hotels]);
    }

    //get top 5
    public function getTop5(Request $req)
    {
        $hotel =  array();
        foreach (Hotel::orderBy('rank_point', 'desc')->take(5)->get()->toArray() as $key => $value) {
            $tam = array();
            $tam['hotel'] = $value;
            if (HotelFollowing::where('customer_id', $req->id)->where('hotel_id', $value['id'])->first() != null) $tam['follow'] = true;
            else $tam['follow'] = false;
            $hotel[] = $tam;
        }
        return response()->json(['top5' => $hotel]);
    }

    //get hotels/create
    public function create()
    {
        return;
    }

    //post hotels
    public function store()
    {
        return;
    }

    //get hotels/{hotels}
    public function show($id)
    {
        $status = false;
        $hotel = null;
        if($id>0){
            $hotel = Hotel::find($id);
            if($hotel !=null){
                $status = true;                
                $hotel->Address;
                $hotel->HotelType;
                foreach($hotel->Room as $r){
                    $r->RoomMode;
                    $tempRoomType = $r->RoomType;
                    foreach($r->RoomBedType as $rBT){
                        $rBT->BedType;
                    }
                    foreach($r->Feature as $f){
                        $f->Feature;
                    };
                    $tempRoomType->ServiceRoomTypeByHotel($hotel->id);
                    
                    $servicesRoomType = ServiceRoomType::where('room_type_id',$tempRoomType->id)->where('hotel_id',$hotel->id)->get();
                    $teampService = null;
                    foreach($servicesRoomType as $sRT){
                         $teampService[]=$sRT->Service;
                    }            
                    $r->service = $teampService;
                    $r->bookingAmount =1;
                }                
            }            
        }
        return response()->json(['status' => $status, 'data' => $hotel]);
    }

    //hotels/{hotels}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch hotels/{hotels}
    public function update($id)
    {
        return;
    }

    //delete hotels/{hotels}
    public function destroy($id)
    {
        return;
    }

    public function getHotel($id)
    {
        return response()->json(['data' => Hotel::find($id)->toArray()]);
    }
}
