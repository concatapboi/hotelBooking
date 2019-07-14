<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Models\Review;
use App\Models\UserImage;
use App\Models\Customer;
use Auth;
use JWTAuth;
use Validator;
use Hash;
use Session;
use App\Models\CustomerReview;

class CommentController extends Controller
{
    //get comment
    public function index()
    {
        return;
    }

    //get comment/create
    public function store(Request $req)
    {
        $data = $req->comment;
        $review = Review::find($data['review_id']);
        if ($review == null || strlen($data['content']) == 0)
            return response()->json([
                'status' => false,
            ]);
        $comment = Comment::create([
            'content' => $data['content'],
            'review_id' => $review->id,
            'customer_id' => Auth::user()->id,
        ]);
        $review->update([
            'comments' =>$review->comments+1,
        ]);
        $comment->customer = $comment->Customer();
        return response()->json([
            'status' => true,
            'comment' => $comment
        ]);
    }

    //post comment
    public function create()
    {
        return;
    }

    //get comment/{comment}
    public function show($id)
    {
        return;
    }

    //comment/{comment}/edit
    public function edit($id)
    {
        return;
    }

    //put/patch comment/{comment}
    public function update($id, Request $req)
    {
        return;
    }

    //delete comment/{comment}
    public function destroy($id)
    {
        return;
    }
}
