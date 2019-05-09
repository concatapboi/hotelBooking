<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelFollowing extends Model
{
  protected $table = 'hotel_following';

  protected $fillable =[
    'customer_id',
    'hotel_id',
  ];
}
