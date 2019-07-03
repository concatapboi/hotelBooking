<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use App\Http\Resources\RoomTypeResource;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\HotelType;
use App\Models\User;
use App\Models\Booking;
use App\Models\HotelImage;
use App\Models\ServiceRoomType;
use Validator;
use App\Models\RoomType;
use Hash;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Intervention\Image\ImageManagerStatic as Image;


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
        $panel = [];
        foreach ($arrayHotelRaw as $key => $hotel) {
            $panel[] = false;
            $arrayHotel[] = new HotelResource($hotel);
        }
        return response()->json([
            "status" => true,
            "data" => $arrayHotel,
            "panel" => $panel,
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
        $data = [
            "name" => $request->name,
            "email" => $request->email,
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
            'email' => 'required',
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
        $images = $request->images;
        $length = sizeof($images);
        for ($i = 0; $i < $length; $i++) {
            $name = time() . str_random(10);
            $image = Image::make($images[$i]["image_link"])->resize(200, 200)->save(public_path("images/hotel/" . $name));
            $primary = 0;
            if ($images[$i]["is_primary"] == 1) {
                $primary = 1;
            }
            HotelImage::create([
                "image_link" => $image->filename,
                "is_primary" => $primary,
                "hotel_id" => $hotel->id,
            ]);
        }
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
            "email" => $request->email,
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
        $images = $request->images;
        $length = sizeof($images);
        $primaryId = $request->primaryId;
        $temp = [];
        for ($i = 0; $i < $length; $i++) {
            //hình cũ
            if (strpos($images[$i]["image_link"], 'data:image') === false) {
                $explode = explode("/", $images[$i]["image_link"]);
                $imageName = ($explode[5]);
                $temp[] = $imageName;
            }
        }
        $oldImage = HotelImage::where("hotel_id", $hotel->id)
            ->whereNotIn("image_link", $temp)
            ->delete();
        for ($i = 0; $i < $length; $i++) {
            //hình mới
            if (strpos($images[$i]["image_link"], 'data:image') !== false) {
                $name = time() . str_random(10);
                $image = Image::make($images[$i]["image_link"])
                    ->resize(200, 200)
                    ->save(public_path("images/hotel/" . $name));

                $a = HotelImage::create([
                    "image_link" => $image->filename,
                    "is_primary" => 0,
                    "hotel_id" => $hotel->id,
                ]);
                $temp[] = $a->image_link;
            }
        }
        HotelImage::where("hotel_id", $hotel->id)
            ->where("is_primary", 1)
            ->update(["is_primary" => 0]);
        for ($i = 0; $i < $length; $i++) {
            if ($images[$i]["is_primary"] == 1) {
                $explode = explode("/", $images[$i]["image_link"]);
                $imageName = ($explode[5]);
                HotelImage::where("hotel_id", $hotel->id)
                    ->where("image_link", $imageName)
                    ->update(["is_primary" => 1]);
            }
        }
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
    public function search(Request $request)
    {
        $place = $request->place;
        $checkIn = $request->checkIn;
        $checkOut = $request->checkOut;
        $stars = $request->stars;
        $services = $request->service;
        $districts = $request->district;
        $hotelTypes = $request->hotelType;
        $price = $request->price;
        $roomTypes = $request->roomType;
        //---------------------------------
        $checkinExplode = explode("-", $checkIn);
        $checkoutExplode = explode("-", $checkOut);
        $checkIn = Carbon::createMidnightDate($checkinExplode[0], $checkinExplode[1], $checkinExplode[2]);
        $checkOut = Carbon::createMidnightDate($checkoutExplode[0], $checkoutExplode[1], $checkoutExplode[2]);
        $data = [];
        if ($place != null && $province = Province::where("name", $place)->first()) {
            foreach ($province->District as $district) {
                foreach ($district->Ward as $ward) {
                    $arrayHotels = $ward->Hotel;
                    if (sizeOf($arrayHotels) > 0) {
                        foreach ($arrayHotels as $hotel) {
                            $data[] = new HotelResource($hotel);
                        }
                    }
                }
            }
        }
        $data = $this->filterByDate($data, $checkIn, $checkOut, $roomTypes);
        if (is_array($districts) && sizeOf($districts) > 0) {
            $data = $this->filterByDistrict($data, $districts);
        }
        if (is_array($stars) && sizeOf($stars) > 0) {
            $data = $this->filterByStar($data, $stars);
        }

        if (is_array($services) && sizeOf($services) > 0) {
            $data = $this->filterByService($data, $services);
        }
        if (is_array($hotelTypes) && sizeOf($hotelTypes) > 0) {
            $data = $this->filterByHotelType($data, $hotelTypes);
        }
        if (is_array($price) && sizeOf($price) > 0) {
            $data = $this->filterByPrice($data, $price);
        }
        return $data;
        return response()->json([
            "status" => true,
            "data" => $data,
        ]);
    }
    public function filterByDate($data, $checkIn, $checkOut, $roomTypes)
    {
        $temp = [];
        if ($checkIn->lessThan($checkOut) && $checkIn->notEqualTo($checkOut)) {
            foreach ($data as $hotel) {
                foreach ($hotel->Room as $room) {
                    if ($room->availableRoomAmount($checkIn, $checkOut) > 0) {
                        if (is_array($roomTypes) && sizeOf($roomTypes) > 0) {
                            foreach ($roomTypes as $roomType) {
                                if ($room->room_type_id == $roomType) {
                                    $temp[] = $hotel->id;
                                }
                            }
                        } else {
                            $temp[] = $hotel->id;
                        }
                    }
                }
            }
            $temp = array_count_values($temp);
            $tempData = [];
            foreach ($temp as $hotelId => $value) {
                foreach ($data as $hotel) {
                    if ($hotel->id == $hotelId) {
                        $tempData[] = $hotel;
                    }
                }
            }
            $data = $tempData;
            return $data;
        } else {
            return response()->json([
                "status" => false,
                "message" => "please choose valid date",
            ]);
        }
    }
    public function filterByDistrict($array, $district)
    {
        $temp = [];
        foreach ($district as $districtId) {
            foreach (District::find($districtId)->Ward as $ward) {
                $arrayHotels = $ward->Hotel;
                if (sizeOf($arrayHotels) > 0) {
                    foreach ($arrayHotels as $hotel) {
                        $temp[] = $hotel->id;
                    }
                }
            }
        }
        $data = [];
        foreach ($array as $hotel) {
            foreach ($temp as $hotelId) {
                if ($hotel->id == $hotelId) {
                    $data[] = $hotel;
                }
            }
        }
        return $data;
    }
    public function filterByStar($array, $stars)
    {

        $collection = collect($array);
        $data = $collection->whereIn("stars_num", $stars)->all();
        return $data;
    }
    public function filterByService($array, $services)
    {
        $temp = [];
        foreach ($array as $hotel) {
            $id = $hotel->id;
            foreach ($services as $serviceId) {
                $a = ServiceRoomType::where("hotel_id", $id)->where("service_id", $serviceId)->first();
                if ($a != null) {
                    $temp[] = $hotel->id;
                }
            }
        }
        // chi can co 1 se hien thi
        //------------------------------------
        // $temp = array_unique($temp);
        //------------------------------------
        //phai co du moi hien thi
        //------------------------------------
        $arrayCountValue  = array_count_values($temp);
        $temp = [];
        foreach ($arrayCountValue as $key => $value) {
            if ($value == sizeOf($services)) {
                $temp[] = $key;
            }
        }
        //------------------------------------
        $data = [];
        foreach ($array as $hotel) {
            foreach ($temp as $hotelId) {
                if ($hotel->id == $hotelId) {
                    $data[] = $hotel;
                }
            }
        }
        return $data;
    }
    public function filterByHotelType($array, $hotelTypes)
    {
        $collection = collect($array);
        $data = $collection->whereIn("hotel_type_id", $hotelTypes)->all();
        return $data;
    }
    public function filterByPrice($array, $price)
    {
        $priceMin = $price[0];
        $priceMax = $price[1];
        $temp = [];
        foreach ($array as $hotel) {
            foreach ($hotel->Room as $room) {
                if ($room->price > $priceMin && $room->price < $priceMax) {
                    $temp[] = $hotel->id;
                }
            }
        }
        $temp = array_unique($temp);
        $data = [];
        foreach ($array as $hotel) {
            foreach ($temp as $hotelId) {
                if ($hotel->id == $hotelId) {
                    $data[] = $hotel;
                }
            }
        }
        return $data;
    }
    // public function remove_duplicate_hotel_in_array($array, $numberOfService)
    // {
    //     $temp = [];
    //     //--------------van show khi match 1 trong cac service
    //     // foreach($array as $hotel){
    //     //     if(empty($temp)){
    //     //         $temp[] = $hotel;
    //     //     }else{
    //     //         foreach($temp as $t){
    //     //             if($t->id != $hotel->id){
    //     //                 $temp[] = $hotel;
    //     //             }
    //     //         }
    //     //     }
    //     // }
    //     //---------------chi show khi match tat ca cac service
    //     $data = [];
    //     $number = 0;
    //     $childTemp = [];
    //     for ($i = 0; $i < sizeOf($array); $i++) {
    //         $childTemp[$array[$i]->id] = 0;
    //     }
    //     for ($i = 0; $i < sizeOf($array); $i++) {
    //         $idToCheck = $array[$i]->id;
    //         if ($array[$i]->id == $idToCheck) {
    //             $childTemp[$array[$i]->id]++;
    //         }
    //         if ($i == sizeOf($array) - 1) {
    //             $number = 0;
    //         }
    //         $temp[] = $childTemp;
    //     }
    //     return $temp;
    // }
}
