<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HotelResource;
use App\Models\Hotel;
use App\Models\HotelType;
use App\Models\User;
use App\Models\HotelAddress;
use Validator;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *"
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd(HotelType::find(1)->Hotel);
        $token =  $request->api_token;
        $arrayHotelRaw = User::where("api_token", $token)->first()->HotelManager->first()->Hotel;
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
        $a = HotelAddress::create([
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
}
