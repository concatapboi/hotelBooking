<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HotelResource;

class Booking extends Model
{
  protected $table = 'booking';

  protected $fillable = [
    'hotel_name',
    'contact_name',
    'room_price',
    'room_amount',
    'check_in',
    'check_out',
    'contact_email',
    'contact_phone',
    'contact_address',
    'special_request',
    'fax_number',
    'coupon_code',
    'discount_value',
    'customer_id',
    'payment_method_id',
    'status_id',
    'room_id',
  ];

  public function Status()
  {
    return $this->belongsTo('App\Models\BookingStatus', 'status_id', 'id');
  }

  public function PaymentMethod()
  {
    return $this->belongsTo('App\Models\PaymentMethod', 'payment_method_id', 'id');
  }

  public function Customer()
  {
    return $this->belongsTo('App\Models\Customer', 'customer_id', 'user_id');
  }

  public function Room()
  {
    return $this->belongsTo('App\Models\Room', 'room_id', 'id');
  }

  public function Hotel()
  {
    $room = $this->Room;
    $hotel = new HotelResource(Hotel::find($room->hotel_id));
    return $hotel;
  }
}
