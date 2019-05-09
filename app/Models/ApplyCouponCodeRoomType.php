<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyCouponCodeRoomType extends Model
{
  protected $table = 'apply_coupon_code_room_type';

  protected $fillable =[
    'coupon_code_id',
    'room_type_id',
  ];
}
