<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Hash;
use Session;

class NotificationsController extends Controller
{
    //get notifications
    public function index(Request $req)
    {
        $user = Auth::user();
        $nofications = array();
        foreach($user->unreadNotifications as $n){
            $nofications[] = $n->data;
        };
        return response()->json([
            'data' => $nofications
        ]);
    }

    //get notifications/create
    public function create()
    {
        return;
    }

    //post notifications
    public function store()
    {
        return;
    }

    //get notifications/{notifications}
    public function show($id)
    {
        return;
    }

    //notifications/{notifications}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch notifications/{notifications}
    public function update($id, Request $req)
    {
        return;
    }

    //delete notifications/{notifications}
    public function destroy($id)
    {
        return;
    }
}
