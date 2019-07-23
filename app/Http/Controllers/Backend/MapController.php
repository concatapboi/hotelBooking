<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class MapController extends Controller
{
    public $key = "11f82a7e50bc28";
    public function getLocation(Request $request)
    {
        $client = new Client();
        $location = $request->address;
        $query = "https://us1.locationiq.com/v1/search.php?key=" . $this->key . "&q=" . $location . "&format=json";
        // $data = json_decode(file_get_contents($query), true);
        $req = $client->request('get', $query);
        $response = $req->getBody();
        $data = json_decode($response, true);
        if (sizeOf($data)  == 0) {
            
            return response()->json([
                "status" => false,
                "message" => "sorry we can't find this location",
            ]);
        }else{
            return response()->json([
                "status" => true,
                "location" => $data[0],
            ]);
        }
    }
}
