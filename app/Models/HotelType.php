<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelType extends Model
{
  protected $table = 'hotel_type';

  protected $fillable =[
    'name',
    'meta_name',
  ];
}
