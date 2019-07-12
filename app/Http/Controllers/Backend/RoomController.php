<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomBedType;
use App\Models\Room;
use App\Models\RoomImage;
use App\Models\RoomType;
use App\Http\Resources\RoomResource;
use App\Models\Hotel;
use App\Models\Service;
use App\Models\ServiceRoomType;
use function GuzzleHttp\json_decode;
use App\Http\Resources\RoomBedTypeResource;
use Intervention\Image\ImageManagerStatic as Image;


class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $rooms =  Room::where("hotel_id", $request->hotelId)->get();
        $result = [];
        foreach ($rooms as $room) {
            // dd($room);
            $result[$room->RoomMode->name][] = new RoomResource($room);
        }
        return response()->json([
            "status" => true,
            "data" => $result,
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
        $room = Room::create($request->all());
        $beds = $request->bed;
        // return $beds;
        foreach ($beds as $bed) {
            // $bed = json_decode($bed);
            RoomBedType::updateOrCreate([
                "bed_type_id" => $bed["bedTypeId"],
                "room_id" => $room->id,
                "amount" => $bed["amount"],
            ]);
        }
        $images = $request->images;
        // return $request->images;
        $length = sizeof($images);
        for ($i = 0; $i < $length; $i++) {
            $name = time() . str_random(10);
            $image = Image::make($images[$i]["image_link"])->resize(200, 200)->save(public_path("images/room/" . $name));
            $primary = 0;
            if ($images[$i]["is_primary"] == 1) {
                $primary = 1;
            }
            RoomImage::create([
                "image_link" => $image->filename,
                "is_primary" => $primary,
                "room_id" => $room->id,
            ]);
        }
        return response()->json([
            "status" => true,
            "message" => "room created",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);
        $beds = RoomBedType::where("room_id", $id)->get();
        $temp = [];
        foreach ($beds as $bed) {
            $temp[] = new RoomBedTypeResource($bed);
        }
        return response()->json([
            "status" => true,
            "data" => new RoomResource($room),
            "bed" => $temp,
        ]);
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
        $room = Room::find($id);
        if ($room != null) {
            $room->update($request->all());
            $beds = $request->bed;
            RoomBedType::where("room_id", $id)->delete();
            foreach ($beds as $bed) {
                $bed = json_decode($bed);
                RoomBedType::updateOrCreate([
                    "bed_type_id" => $bed->bedTypeId,
                    "room_id" => $id,
                    "amount" => $bed->amount,
                ]);
            }
            return response()->json([
                "status" => true,
                "message" => "room updated",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "messages" => "cant find room with this id"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::find($id);
        if ($room != null) {
            $room->delete();
            return response()->json([
                "status" => true,
                "messages" => "room deleted!!!"
            ]);
        } else {
            return response()->json([
                "status" => false,
                "messages" => "cant find room with this id"
            ]);
        }
    }
    public function getAllRoomByHotelId(Request $request)
    {
        $hotel = Hotel::find($request->hotelId);
        $result = [];
        foreach ($hotel->Room as $room) {
            $result[] = new RoomResource($room);
        }
        return response()->json([
            "status" => true,
            "data" => $result,
        ]);
    }
}
