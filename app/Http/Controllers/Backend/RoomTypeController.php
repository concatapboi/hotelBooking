<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Hotel;
use App\Http\Resources\RoomTypeResource;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roomModeId = $request->roomModeId;
        $hotel = Hotel::find($request->hotelId)->first();
        $arrayRoomType = RoomType::all()->toArray();
        foreach ($hotel->Room as $hotelRoom) {
            $roomMode = $hotelRoom->room_mode_id;
            if ($roomMode == (int)$roomModeId) {
                foreach ($arrayRoomType as $key => $roomType) {
                    if ($roomType['id'] == $hotelRoom->room_type_id) {
                        array_splice($arrayRoomType, $key, 1);
                    }
                }
            }
        }
        return response()->json([
            "status" => true,
            "data" => $arrayRoomType,
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
    public function getAllRoomType()
    {
        
        $result = [];
        foreach ($roomTypes as $roomType) {
            $result[] = new RoomTypeResource($roomType);
        }
        return response()->json([
            "status" => true,
            "data" => $result,
        ]);
    }
}
