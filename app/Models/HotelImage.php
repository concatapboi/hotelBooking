<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelImage extends Model
{
  protected $table = 'hotel_image';

  protected $fillable =[
    'image_link',
    'is_primary',
    'hotel_id',
  ];
}
