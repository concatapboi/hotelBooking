<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use App\Http\Resources\RoomTypeResource;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\HotelType;
use App\Models\User;
use App\Models\HotelAddress;
use App\Models\ServiceRoomType;
use Validator;
use App\Models\RoomType;
use Hash;
use Auth;


class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *"
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $arrayHotelRaw = Auth::user()->HotelManager->first()->Hotel;
        $arrayHotel = [];
        foreach ($arrayHotelRaw as $key => $hotel) {
            $arrayHotel[] = new HotelResource($hotel);
        }
        return response()->json([
            "status" => true,
            "data" => $arrayHotel,
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
        if ($request->arrayService != null) {
            dd($request->arrayService);
        }
        dd(1);
        $data = [
            "name" => $request->name,
            "meta_name" => preg_replace("/\s+/", "-", trim($request->name)),
            "hotel_type_id" => $request->hotelType,
            "hotel_manager_id" => $request->hotel_manager_id,
            "description" => $request->description,
            "province" => $request->province,
            "district" => $request->district,
            "ward" => $request->ward,
            "address" => $request->address,
            "credit_card" => $request->credit_card,
            "phone_number" => $request->phone,
            "fax_number" => $request->fax_number,
            "tax_code" => $request->tax_code,
            "stars_num" => $request->stars_num,
        ];
        $validator = Validator::make($data, [
            'name' => 'required|unique:hotel',
            'hotel_type_id' => 'required|exists:hotel_type,id',
            'description' => 'required',
            'province' => 'required|exists:province,id',
            'district' => 'required|exists:district,id',
            'ward' => 'required|exists:ward,id',
            'address' => 'required',
            'credit_card' => 'required',
            'phone_number' => 'required',
            'fax_number' => 'required',
            'tax_code' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors(),
            ]);
        }
        $hotel = Hotel::create($data);
        HotelAddress::create([
            "hotel_id" => $hotel->id,
            "ward_id" => $request->ward,
            "address" => $request->address,
        ]);

        return response()->json([
            "status" => true,
            "id" => $hotel->id,
            "message" => "Hotel Created !!!",
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
        $data = [
            "name" => $request->name,
            "meta_name" => preg_replace("/\s+/", "-", trim($request->name)),
            "hotel_type_id" => $request->hotelType,
            "hotel_manager_id" => $request->hotel_manager_id,
            "description" => $request->description,
            "province" => $request->province,
            "district" => $request->district,
            "ward" => $request->ward,
            "address" => $request->address,
            "credit_card" => $request->credit_card,
            "phone_number" => $request->phone,
            "fax_number" => $request->fax_number,
            // "stars_num" => $request->stars_num,
            "tax_code" => $request->tax_code,
            "stars_num" => $request->stars_num,
        ];
        $validator = Validator::make($data, [
            'name' => 'required',
            'hotel_type_id' => 'required|exists:hotel_type,id',
            'description' => 'required',
            'province' => 'required|exists:province,id',
            'district' => 'required|exists:district,id',
            'ward' => 'required|exists:ward,id',
            'address' => 'required',
            'credit_card' => 'required',
            'phone_number' => 'required',
            'fax_number' => 'required',
            'tax_code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $validator->errors(),
            ]);
        }
        $hotel = Hotel::find($id);
        $hotel->update($data);
        $hotelAdrress = HotelAddress::where('hotel_id', $hotel->id)->first();
        $hotelAdrress->update([
            "hotel_id" => $hotel->id,
            "ward_id" => $request->ward,
            "address" => $request->address,
        ]);

        return $hotel;
        return response()->json([
            "status" => true,
            "message" => "Hotel updated !!!",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $token =  $request->api_token;
        // $arrayHotelRaw = User::where("api_token", $token)->first()->HotelManager->first()->Hotel;
        $hotel = Hotel::find($id);
        if ($hotel == null) {
            return response()->json([
                "status" => false,
                "data" => "can't find hotel with this ID",
            ]);
        } else {
            Hotel::destroy($id);
            return response()->json([
                "status" => true,
                "data" => "hotel deleted",
            ]);
        }
    }
    public function addService(Request $request)
    {
        $hotel = Hotel::find($request->hotelId);
        $choice = $request->radio;
        $service = $request->serviceId;
        $this->addAllRoom($request);
        // if ($hotel != null) {
        //     $roomTypes = [];
        //     $rooms = Room::where("hotel_id", $request->hotelId)->get();
        //     $temp = [];
        //     foreach ($rooms as $room) {
        //         $temp[$room->room_type_id] = $room->room_type_id;
        //     }
        //     // dd($temp);
        //     if ($choice === "all") {
        //         foreach ($temp as $roomType) {
        //             $roomTypes[] = $roomType;
        //         }
        //     } else if ($choice === "some") {
        //         $roomTypes = $request->chosenRoom;
        //     }
        //     foreach ($roomTypes as $roomTypeId) {
        //         ServiceRoomType::updateOrCreate(
        //             [
        //                 "service_id" => $request->serviceId,
        //                 "room_type_id" => $roomTypeId,
        //                 "hotel_id" => $hotel->id,
        //             ]
        //         );
        //     }
        // } else {
        //     return ("ko dc");
        // }
    }
    public function removeServiceRoom(Request $request)
    {
        ServiceRoomType::where("hotel_id", $request->hotelId)->where("service_id", $request->serviceId)->delete();
    }
    public function addAllRoom(Request $request)
    {
        $hotel = Hotel::find($request->hotelId);
        if ($hotel != null) {
            $rooms = Room::where("hotel_id", $request->hotelId)->get();
            $temp = [];
            foreach ($rooms as $room) {
                $temp[$room->room_type_id] = $room->room_type_id;
            }
            foreach ($temp as $roomTypeId) {
                ServiceRoomType::updateOrCreate(
                    [
                        "service_id" => $request->serviceId,
                        "room_type_id" => $roomTypeId,
                        "hotel_id" => $hotel->id,
                    ]
                );
            }
        }
    }
    public function addServiceRoom(Request $request)
    {
        $hotel = Hotel::find($request->hotelId);
        foreach ($request->chosenRoom as $roomTypeId) {
            ServiceRoomType::updateOrCreate(
                [
                    "service_id" => $request->serviceId,
                    "room_type_id" => $roomTypeId,
                    "hotel_id" => $hotel->id,
                ]
            );
        }
    }
    public function getAllRoomType(Request $request)
    {
        $hotel =  Hotel::find($request->hotelId);
        $arrayRoomTypes = [];
        $arrayRoomTypeId = [];
        foreach ($hotel->Room as $room) {
            $roomType = RoomType::find($room->room_type_id);
            if (empty($arrayRoomTypeId)) {
                $arrayRoomTypeId[] = $roomType->id;
                $arrayRoomTypes[] = new RoomTypeResource($roomType);
            } else {
                if (!$this->array_remove_duplicate($arrayRoomTypeId, $roomType->id)) {
                    $arrayRoomTypeId[] = $roomType->id;
                    $arrayRoomTypes[] = new RoomTypeResource($roomType);
                }
            }
        }
        return response()->json([
            "status" => true,
            "data" => $arrayRoomTypes,
        ]);
    }
    public function getAllRoomTypes()
    {
        # code...
    }
    public function array_remove_duplicate($array, $field)
    {
        foreach ($array as $key => $value) {
            if ($value == $field) {
                return true;
            }
        }
        return false;
    }
}
