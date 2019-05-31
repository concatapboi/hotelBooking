<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  protected $table = 'hotel';

  protected $fillable =[
    'verified',
    'credit_card',
    'rank_point',
    'description',
    'stars_num',
    'name',
    'meta_name',
    'tax_code',
    'review_point',
    'fax_number',
    'phone_number',
    'coint',
    'hotel_type_id',
    'hotel_manager_id',
  ];
  public function HotelType(){
		return $this->belongsTo('App\Models\HotelType','hotel_type_id','id');
  }
  public function HotelManager(){
		return $this->belongsTo('App\Models\HotelManager','hotel_manager_id','user_id');
  }
  public function Address(){
		return $this->belongsTo('App\Models\HotelAddress','id','hotel_id');
	}
}
