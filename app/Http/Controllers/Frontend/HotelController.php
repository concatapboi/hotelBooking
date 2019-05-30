<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    //get hotels
    public function index(Request $req)
    {
        return response()->json(['data' => Hotel::find($req->id)->toArray()]);
    }

    //get top 5
    public function getTop5()
    {
        return response()->json(['top5' => Hotel::orderBy('rank_point', 'desc')->take(5)->get()->toArray()]);
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
