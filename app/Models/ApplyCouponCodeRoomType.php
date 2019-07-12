<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyCouponCodeRoomType extends Model
{
  protected $table = 'apply_coupon_code_room_type';

  protected $fillable = [
    'coupon_code_id',
    'room_type_id',
  ];

  public function CouponCode()
  {
    return $this->belongsTo('App\Models\CouponCode', 'coupon_code_id', 'id');
  }

  public function RoomType()
  {
    return $this->belongsTo('App\Models\RoomType', 'room_type_id', 'id');
  }
}
