<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomBedType extends Model
{
  protected $table = 'room_bed_type';

  protected $fillable =[
    'bed_type_id',
    'room_id',
  ];
}
