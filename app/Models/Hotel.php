<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HotelTypeResource;
use App\Models\Booking;
use App\Models\RoomMode;
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
    'address',
    'email',
    'meta_name',
    'child_age',
    'tax_code',
    'review_point',
    'fax_number',
    'phone_number',
    'coin',
    'ward_id',
    'hotel_type_id',
    'hotel_manager_id',
  ];

  public function HotelType()
  {
    return $this->belongsTo('App\Models\HotelType', 'hotel_type_id', 'id');
  }
  public function RoomMode()
  {
    $temp = [];
    foreach ($this->Room as $room) {
      $temp[] = $room->room_mode_id;
    }
    $roomMode = [];
    $roomModeIds = array_unique($temp);
    foreach ($roomModeIds as $roomModeId) {
      $roomMode[] = RoomMode::find($roomModeId);
    }
    return $roomMode;
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
  public function CouponCode()
  {
    return $this->hasMany('App\Models\CouponCode', 'hotel_id', 'id');
  }
  public function getCouponCode()
  {
    $couponCodes = $this->CouponCode;
    $temp = array();
    foreach ($couponCodes as $couponCode) {
      if (!Carbon::now()->lessThan(Carbon::parse($couponCode->start_at))) {
        if ($couponCode->end_at == null || Carbon::now()->lessThan(Carbon::parse($couponCode->end_at))) {
          $temp[] = $couponCode;
        }
      }
    }
    return $temp;
  }
  public function RoomByPrice()
  {
    return $this->hasMany('App\Models\Room', 'hotel_id', 'id')->orderBy('price');
  }

  public function reviewList($id)
  {
    $reviews = Review::where('hotel_id', $this->id)->get();
    foreach ($reviews as $r) {
      $r->booking = $r->bookingDetail();
      $r->useful = false;
      $r->customer = $r->Customer();
      // $r->avatar = UserImage::where('user_id', $r->customer_id)->where('is_primary', 1)->first();
      if ($id != null) {
        $customerReview = $r->CustomerReview($id, $r->id);
        if ($customerReview != null && $customerReview->useful != 0) $r->useful = true;
      }
    }
    return $reviews;
  }

  public function questionList()
  {
    $question = Question::where('hotel_id', $this->id)->get();
    foreach ($question as $q) {
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
    // return $this->hasMany('App\Models\ServiceRoomType', 'hotel_id', 'id');
    // return $this->belongsToMany('App\Models\Service','service_room_type', 'service_id', 'hotel_id');
    return $this->belongsToMany('App\Models\Service', 'service_room_type', 'hotel_id', 'service_id');
  }
  public function ServiceRoomType()
  {
    return $this->hasMany('App\Models\ServiceRoomType', 'service_id', 'id');
  }
  public function RoomType()
  {
    // return $this->hasMany('App\Models\ServiceRoomType', 'hotel_id', 'id');
    return $this->belongsToMany('App\Models\RoomType', 'service_room_type', 'room_type_id', 'hotel_id');
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
  public function Policy()
  {
    return $this->hasOne('App\Models\Policy', 'hotel_id', 'id');
  }
  public function countRoomByTypes($roomTypesID)
  {
    $hotel = $this->where('id', $this->id)->with(['Room' => function ($query) {
      $query = $query->with('RoomType');
    }])->first();
    // $data = collect($hotel->room)->groupBy('room_type_id');
    // foreach($data->toArray() as $key => $value){
    //   if(in_array($key,$roomTypesID)) $count++;
    // }
    $data = collect($hotel->room)->groupBy('room_type_id')->filter(function ($value, $key) use ($roomTypesID) {
      if (in_array($key, $roomTypesID)) return $value;
    });
    return $data->count();
  }

  public function paymentMethods()
  {
    $policy = $this->Policy;
    $paymentMethods = array();
    switch ($policy->cancelable) {
      case 0:
        $tempCase0 = array();
        $tempCase0['method'] = PaymentMethod::find(1);
        $tempCase0['content'] = 'Sau khi yêu cầu đặt phòng được chấp nhận, bạn không thể hủy đơn đặt phòng.';
        $paymentMethods[] = $tempCase0;
        break;
      default:
        for ($i = 1; $i <= 2; $i++) {
          $tempDefault = array();
          $tempDefault['method'] = PaymentMethod::find($i);
          $tempDefault['content'] = 'Sau khi yêu cầu đặt phòng được chấp nhận, bạn có thể hủy đơn đặt phòng trước ngày Check-In ' . $policy->cancelable . ' ngày.';
          if ($i == 2) {
            if ($policy->can_refund == 0) {
              $tempDefault['content'] = $tempDefault['content'] . ' Tuy nhiên, bạn sẽ không được hoàn trả phía đã thanh toán.';
            } else {
              $tempDefault['content'] = $tempDefault['content'] . '  Chúng tôi chấp nhận hoàn trả ' . $policy->can_refund . '% các chi phí mà bạn đã thanh toán.';
            }
          }
          $paymentMethods[] = $tempDefault;
        }
        break;
    }
    return $paymentMethods;
  }
  public function Ward()
  {
    return $this->belongsTo('App\Models\Ward', 'ward_id', 'id');
  }
  public function BookingList($id)
  {
    return $this->where("id", $id)->with(["Room" => function ($query) {
      $query->with("Booking");
    }])->get();
  }
  public function Review()
  {
    return $this->hasMany('App\Models\Review', 'hotel_id', 'id');
  }
  public function getReviewPoint()
  {
    $reviews = Review::where('hotel_id',$this->id)->get();
    $count = sizeOf($reviews);
    $point = 0;
    foreach ($reviews as $review) {
      $point += $review->point;
    }
    if ($count != 0)
      return $point / $count;
    else
      return 0;
  }
}
