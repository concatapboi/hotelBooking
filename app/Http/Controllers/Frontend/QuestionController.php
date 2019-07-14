<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Comment;
use App\Models\Review;
use App\Models\Quetsion;
use Auth;
use Validator;
use Hash;
use Session;
use App\Models\Question;

class QuestionController extends Controller
{
    //get question
    public function index()
    {
        return;
    }

    //get question/create
    public function create(Request $req)
    {
        $validateData = Validator::make(
            $req->all(),
            [
                'title' => 'required',
                'content' => 'required'
            ],
            [
                'title.required' => 'Title is empty!',
                'content.required' => 'Content is empty!',
            ]
        );
        if ($validateData->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validateData->errors(),
            ]);
        }
        $question = Question::create([
            'title' => $req->title,
            'content' => $req->content,
            'customer_id' => Auth::user()->id,
            'hotel_id' => $req->hotel_id,
        ]);
        return response()->json([
            'status' => true,
            'errors' => null,
        ]);
    }

    //post question
    public function store()
    {
        return;
    }

    //get question/{hotels}
    public function show($id)
    {
        return;
    }

    //question/{question}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch question/{question}
    public function update($id, Request $req)
    {
        return;
    }

    //delete question/{question}
    public function destroy($id)
    {
        return;
    }
}
