<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Comment;
use App\Models\Review;
use Auth;
use Validator;
use Hash;
use Session;
use App\Models\CustomerReview;

class ReviewController extends Controller
{
    //get review
    public function index()
    {
        $user = Auth::user();
        $arr = $user->reViewList();
        return response()->json([
            'data' => $arr,
        ]);
    }

    //get review/create
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
        $review = Review::create([
            'title' => $req->title,
            'content' => $req->content,
            'point' => $req->star,
            'customer_id' => Auth::user()->id,
            'hotel_id' => $req->hotel_id,
            'can_comment' => $req->can_comment == true ? 1 : 0,
        ]);
        $customerReview = CustomerReview::create([
            'customer_id' => $review->customer_id,
            'review_id' => $review->id,
            'status' => $req->notification == true ? 1 : 0,
            'like' => 0,
            'useful' => 0,
        ]);
        return response()->json([
            'status' => true,
            'errors' => null,
        ]);
    }

    //post review
    public function store()
    {
        return;
    }

    //get review/{hotels}
    public function show($id)
    {
        return;
    }

    //review/{review}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch review/{review}
    public function update($id, Request $req)
    {
        return;
    }

    //delete review/{review}
    public function destroy($id)
    {
        return;
    }
}
