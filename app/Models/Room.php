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
  public function Hotel(){
		return $this->belongsTo('App\Models\Hotel','hotel_id','id');
  }
  public function RoomType(){
		return $this->belongsTo('App\Models\RoomType','room_type_id','id');
  }
  public function RoomMode(){
		return $this->belongsTo('App\Models\RoomMode','room_mode_id','id');
  }
  public function RoomBedType(){
		return $this->hasMany('App\Models\RoomBedType','room_id','id');
  }
  public function Feature(){
		return $this->hasMany('App\Models\RoomFeature','room_id','id');
  }
}
