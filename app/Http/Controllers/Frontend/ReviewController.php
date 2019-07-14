<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Comment;
use App\Models\Booking;
use App\Models\Review;
use Auth;
use Validator;
use Hash;
use Session;
use App\Models\CustomerReview;
use App\Models\UserImage;

class ReviewController extends Controller
{
    //get review
    public function index()
    {
        $arr = array();
        if (Auth::check()) {
            $user = Auth::user();            
            foreach($user->reViewList() as $review){
                $temp = $review;
                $temp->customer = $user;
                $temp->customer->avatar = UserImage::where('user_id',$user->id)->first();
                $arr[] = $temp;
            }
        }
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
                'content' => 'required',
                'hotel_id' => 'required',
                'booking_id' => 'required',
            ],
            [
                'title.required' => 'Title is empty!',
                'content.required' => 'Content is empty!',
                'hotel_id.required' => 'Hotel value is empty!',
                'booking_id.required' => 'Booking value is empty!',
            ]
        );
        if ($validateData->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validateData->errors(),
            ]);
        }
        $b = Booking::find($req->booking_id);
        if ($b == null || $b->reviewAble() == false || Hotel::find($req->hotel_id) == null){
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
            'booking_id' => $req->booking_id,
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
