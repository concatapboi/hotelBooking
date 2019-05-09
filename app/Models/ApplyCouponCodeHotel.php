<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyCouponCodeHotel extends Model
{
  protected $table = 'app_coupon_code_hotel';

  protected $fillable =[
    'coupon_code_id',
    'hotel_id',
  ];
}
