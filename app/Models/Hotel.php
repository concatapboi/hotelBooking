<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HotelTypeResource;
use App\Models\Booking;
use App\Http\Resources\BookingResource;


class Hotel extends Model
{
  protected $table = 'hotel';

  protected $fillable = [
    'verified',
    'credit_card',
    'rank_point',
    'description',
    'stars_num',
    'name',
    'email',
    'meta_name',
    'child_age',
    'tax_code',
    'review_point',
    'fax_number',
    'phone_number',
    'coint',
    'hotel_type_id',
    'hotel_manager_id',
  ];

  public function HotelType()
  {
    return $this->belongsTo('App\Models\HotelType', 'hotel_type_id', 'id');
  }

  public function HotelTypeResource()
  {
    return new HotelTypeResource(HotelType::find($this->hotel_type_id));
  }

  public function HotelManager()
  {
    return $this->belongsTo('App\Models\HotelManager', 'hotel_manager_id', 'user_id');
  }

  public function Address()
  {
    return $this->belongsTo('App\Models\HotelAddress', 'id', 'hotel_id');
  }

  public function Room()
  {
    return $this->hasMany('App\Models\Room', 'hotel_id', 'id')->orderBy('price');
  }

  public function reviewList($id)
  {
    $reviews = Review::where('hotel_id', $this->id)->get();
    foreach ($reviews as $r) {
      $r->useful = false;
      $r->customer = $r->Customer();
      // $r->avatar = UserImage::where('user_id', $r->customer_id)->where('is_primary', 1)->first();
      if ($id != null) {
        $customerReview = $r->CustomerReview($id, $r->id);
        if ($customerReview !=null && $customerReview->useful != 0) $r->useful = true;
      }
    }
    return $reviews;
  }

  public function questionList()
  {
    $question = Question::where('hotel_id', $this->id)->get();
    foreach($question as $q){
      $q->customer = $q->Customer();
      $q->Reply;
    }
    return $question;
  }

  public function ServiceResource()
  {
    $serviceRoomType = ServiceRoomType::select('service_id')->where('hotel_id', $this->id)->distinct()->get()->sortBy('service_id');
    $services = array();
    foreach ($serviceRoomType as $s) {
      $services[] = $s->ServiceResource();
    }
    return  $services;
  }

  public function Service()
  {
    return $this->hasMany('App\Models\ServiceRoomType', 'hotel_id', 'id');
  }

  public function maxPrice()
  {
    $max = 1;
    foreach ($this->Room as $r) {
      if ($max < $r->price) $max = $r->price;
    }
    return $max;
  }

  public function minPrice()
  {
    $min = $this->maxPrice();
    foreach ($this->Room as $r) {
      if ($min > $r->price) $min = $r->price;
    }
    return $min;
  }

  // public function Room()
  // {
  //   return $this->hasMany('App\Models\Room', 'hotel_id', 'id');
  // }

  public function Image()
  {
    return $this->hasMany('App\Models\HotelImage', 'hotel_id', 'id');
  }

  public function Booking()
  {
    $data = [];
    foreach ($this->Room as $room) {
      $bookings = Booking::where("room_id", $room->id)->get();
      if (sizeOf($bookings) > 0) {
        foreach ($bookings as $booking)
          $data[] = new BookingResource($booking);
      }
    }
    return $data;
  }

  public function CancelableStatus()
  {
    $arr = array();
    foreach (BookingStatus::all() as $status) {
      switch ($status->name) {
        case 'Pending':
          $arr[] = $status->id;
          break;
        case 'Wait for payment':
          $arr[] = $status->id;
          break;
        case 'Completed':
          $arr[] = $status->id;
          break;
      }
    }
    return $arr;
  }
}
