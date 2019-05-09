<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
  protected $table = 'room_feature';

  protected $fillable =[
    'feature_id',
    'room_id',
  ];
}
