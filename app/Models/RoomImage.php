<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    protected $table = 'room_image';

  protected $fillable =[
    'image_link',
    'is_primary',
    'room_id',
  ];
}
