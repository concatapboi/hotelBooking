<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Question;
use App\Models\Hotel;
use Validator;
use App\Models\RoomType;
use Hash;
use Carbon\Carbon;
use Auth;

class ReplyController extends Controller
{
    //get reply
    public function index(Request $req)
    {
        return;
    }

    //get reply/create
    public function create()
    {
        return;
    }

    //post reply
    public function store(Request $req)
    {
        $hotel = Hotel::find($req->hotel_id);
        $question = Question::find($req->question_id);
        if($hotel == null || $question == null){
            return response()->json([
                'status' => false,
                'question' => null,
            ]);
        }
        $reply = Reply::create([
            'question_id' => $question->id,
            'content' => $req->text,
        ]);
        $question->reply = $reply;
        $question->customer = $question->Customer();
        return response()->json([
            'status' => true,
            'question' => $question,
        ]);
    }

    //get reply/{reply}
    public function show($id)
    {
        return;
    }

    //reply/{reply}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch reply/{reply}
    public function update($id, Request $req)
    {
        return;
    }

    //delete reply/{reply}
    public function destroy($id)
    {
        return;
    }
}
