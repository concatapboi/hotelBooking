<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelManager extends Model
{
  protected $table = 'hotel_manager';

  protected $fillable =[
    'user_id',
  ];

  public function ofUser(){
     return $this->belongTo('App\Models\User');
   }
}
