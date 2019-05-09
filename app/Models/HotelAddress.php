<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelAddress extends Model
{
  protected $table = 'hotel_address';

  protected $fillable =[
    'ward_id',
    'hotel_id',
  ];
}
