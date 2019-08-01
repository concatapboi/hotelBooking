<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use App\Models\HotelManager;

class HotelManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("Backend.Manager.Pages.index");
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
        return User::find($id);
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
        return $request->all();
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

    public function test()
    {
        return Hotel::all();
    }
    public function getUserByHotel(Request $request)
    {
        return Hotel::find($request->id)->HotelManager->User;
    }
    public function updateUserByHotel(Request $request)
    {
        $user =  Hotel::find($request->id)->HotelManager->User;
        $data = [
            "name" => $request->hotelManager["name"],
            "email" => $request->hotelManager["email"],
            "phone_number" => $request->hotelManager["phone_number"],
        ];
        // return $data;
        $user->update($data);
        
        return response()->json([
            "status" => true,
            "message" => "thông tin đã được cập nhất",
        ]);
    }
}
