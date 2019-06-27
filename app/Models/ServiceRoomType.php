<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRoomType extends Model
{
  protected $table = 'service_room_type';

  protected $fillable =[
    'service_id',
    'room_type_id',
    'hotel_id',
  ];

  public function Service(){
		return $this->belongsTo('App\Models\Service','service_id','id');
  }
}
