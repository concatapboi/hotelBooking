<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Events\MessageSentEvent;
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
use Illuminate\Notifications\Notification;
use App\Notifications\CommentNotification;

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
        if(CustomerReview::where('review_id',$review->id)->where('customer_id',Auth::user()->id)->first()==null){
            $customerReview = CustomerReview::create([
                'customer_id' => Auth::user()->id,
                'review_id' => $review->id,
                'status' => 1,
                'like' => 0,
                'useful' => 0,
            ]);
        }
        $comment->customer = $comment->Customer();
        $user = array();
        $user['name'] = Auth::user()->name;
        $user['id'] = Auth::user()->id;
        $user['avatar'] = $comment->customer->avatar->image_link;
        $link = ['name'=>'review','id'=>$review->id];
        broadcast(new MessageSentEvent($user,$link,'Đã kèm một bình luận.',$comment->content));
        $customer_review = CustomerReview::where('review_id',$review->id)->where('customer_id','<>',Auth::user()->id)->where('status',1)->get();
        foreach($customer_review as $customer){
            User::find($customer->customer_id)->notify(new CommentNotification($user,$comment->review_id));
        }
        // Auth::user()->notify(new CommentNotification($user,$comment->review_id));
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
