<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use Auth;
use Validator;
use Hash;
use Session;

class SearchController extends Controller
{
    public function getSearchingResult(Request $req){
        $status = false;
        $hotels = Hotel::all();
        $arr = array();
        if ($hotels->count()>0) {
            $status = true;
            foreach ($hotels as $h) {
                $h->maxPrice=$h->maxPrice();
                $h->minPrice=$h->minPrice();
            }
        }
        return response()->json(['status' => $status, 'data' => $hotels]);
    }
}
