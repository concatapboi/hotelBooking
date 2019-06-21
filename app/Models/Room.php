<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
  protected $table = 'room';

  protected $fillable =[
    'status',
    'room_name',
    'description',
    'price',
    'max_adult_amount',
    'max_child_amount',
    'room_size',
    'amount',
    'room_mode_id',
    'room_type_id',
    'hotel_id',
  ];
  public function RoomType(){
		return $this->belongsTo('App\Models\RoomType','room_type_id','id');
  }
  public function RoomMode(){
		return $this->belongsTo('App\Models\RoomMode','room_mode_id','id');
  }
  public function Service()
  {
    return $this->belongsToMany('App\Models\Service','service_room_type','room_type_id','service_id');
  }
}
