<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\HotelFollowing;

class HotelController extends Controller
{
    //get hotels
    public function index()
    {
        $status = true;
        $data = array();
        $hotels = Hotel::all();
        if (empty($hotels)) $status = false;
        else{
            foreach($hotels as $hotel){
                $tam = array();
                $tam['item'] = $hotel;
                $tam['type'] = HotelType::find($hotel->hotel_type_id);
                $tam['followers'] = HotelFollowing::where('hotel_id')->count();
                $data[] = $tam;
            }
        }
        return response()->json(['status' => $status, 'data' => $data]);
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
        return;
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
