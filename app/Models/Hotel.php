<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\HotelTypeResource;

class Hotel extends Model
{
  protected $table = 'hotel';

  protected $fillable = [
    'verified',
    'credit_card',
    'rank_point',
    'description',
    'stars_num',
    'name',
    'email',
    'meta_name',
    'child_age',
    'tax_code',
    'review_point',
    'fax_number',
    'phone_number',
    'coint',
    'hotel_type_id',
    'hotel_manager_id',
  ];
  public function HotelType()
  {
    return $this->belongsTo('App\Models\HotelType', 'hotel_type_id', 'id');
  }
  public function HotelTypeResource()
  {
    return new HotelTypeResource(HotelType::find($this->hotel_type_id));
  }
  public function HotelManager()
  {
    return $this->belongsTo('App\Models\HotelManager', 'hotel_manager_id', 'user_id');
  }
  public function Address()
  {
    return $this->belongsTo('App\Models\HotelAddress', 'id', 'hotel_id');
  }
  public function RoomByPrice()
  {
    return $this->hasMany('App\Models\Room', 'hotel_id', 'id')->orderBy('price');
  }
  public function Service()
  {
    $serviceRoomType = ServiceRoomType::select('service_id')->where('hotel_id', $this->id)->distinct()->get()->sortBy('service_id');
    $services = array();
    foreach($serviceRoomType as $s){
      $services[] = $s->ServiceResource();
    }
    return  $services;
  }
  public function maxPrice()
  {
    $max = 1;
    foreach ($this->Room as $r) {
      if ($max < $r->price) $max = $r->price;
    }
    return $max;
  }

  public function minPrice()
  {
    $min = $this->maxPrice();
    foreach ($this->Room as $r) {
      if ($min > $r->price) $min = $r->price;
    }
    return $min;
  }
  public function Room()
  {
    return $this->hasMany('App\Models\Room', 'hotel_id', 'id');
  }
  public function Image()
  {
    return $this->hasMany('App\Models\HotelImage', 'hotel_id', 'id');
  }
}
