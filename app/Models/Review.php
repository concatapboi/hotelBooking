<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $table = 'review';

  protected $fillable = [
    'title',
    'content',
    'useful_point',
    'point',
    'likes',
    'comments',
    'can_comment',
    'customer_id',
    'hotel_id'
  ];

  public function User()
  {
    return $this->belongsTo('App\Models\User', 'customer_id', 'id');
  }

  public function Customer()
  {
    $customer = User::find($this->customer_id);
    $customer->avatar = UserImage::where('user_id', $this->customer_id)->where('is_primary', 1)->first();
    return $customer;
  }

  public function Comment()
  {
    return $this->hasMany('App\Models\Comment', 'review_id', 'id');
  }

  public function Hotel()
  {
    return $this->belongsTo('App\Models\Hotel', 'hotel_id', 'id');
  }

  public function CustomerReview($customerID,$reviewID){
    return CustomerReview::where('customer_id', $customerID)->where('review_id', $reviewID)->first();
  }
}
