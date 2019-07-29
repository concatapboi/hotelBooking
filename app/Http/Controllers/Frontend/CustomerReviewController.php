<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerReview;
use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Customer;
use Auth;
use JWTAuth;
use Validator;
use Hash;
use Session;

class CustomerReviewController extends Controller
{
    public function like(Request $req)
    {
        if (Auth::check()) {
            $customerReview = CustomerReview::where('customer_id', Auth::user()->id)->where('review_id', $req->review_id)->first();
            $review = Review::find($req->review_id);
            if ($customerReview == null || $review == null)
                return response()->json([
                    'status' => false,
                ]);
            switch ($customerReview->like) {
                case 1:
                    $customerReview->update([
                        'like' => 0,
                    ]);
                    $review->update([
                        'likes' => $review->likes - 1,
                    ]);
                    break;
                case 0;
                    $customerReview->update([
                        'like' => 1,
                    ]);
                    $review->update([
                        'likes' => $review->likes + 1,
                    ]);
                    break;
            }
            return response()->json([
                'status' => true,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }

    public function getNotification(Request $req)
    {
        return response()->json([
            'status' => false,
        ]);
    }

    public function updateUseful(Request $req)
    {
        if (Auth::check()) {
            $customerReview = CustomerReview::where('customer_id', Auth::user()->id)->where('review_id', $req->review_id)->first();
            $review = Review::find($req->review_id);
            if ($customerReview == null || $review == null)
                return response()->json([
                    'status' => false,
                ]);
            switch ($customerReview->useful) {
                case 1:
                    $customerReview->update([
                        'useful' => 0,
                    ]);
                    $review->update([
                        'useful_point' => $review->useful_point - 1,
                    ]);
                    break;
                case 0:
                    $customerReview->update([
                        'useful' => 1,
                    ]);
                    $review->update([
                        'useful_point' => $review->useful_point + 1,
                    ]);
                    break;
            }
            return response()->json([
                'status' => true,
            ]);
        }
        return response()->json([
            'status' => false,
        ]);
    }
}
