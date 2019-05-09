<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelRoomType extends Model
{
  protected $table = 'hotel_type';

  protected $fillable =[
    'hotel_id',
    'room_type_id',
  ];
}
