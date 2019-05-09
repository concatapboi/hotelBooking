<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $table = 'room';

  protected $fillable =[
    'status',
    'description',
    'max_adult_amount',
    'max_child_amount',
    'room_size',
    'amount',
    'room_mode_id',
    'room_type_id',
  ];
}
