<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomMode extends Model
{
  protected $table = 'room_mode';

  protected $fillable =[
    'price',
    'name',
    'status',
  ];
}
