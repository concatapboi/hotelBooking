<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CouponCode extends Model
{
  protected $table = 'coupon_code';

  protected $fillable =[
    'code',
    'discount_value',
    'title',
    'content',
    'start_at',
    'end_at',
  ];
}
