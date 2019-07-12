<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomFeature extends Model
{
  protected $table = 'room_feature';

  protected $fillable = [
    'feature_id',
    'room_id',
  ];

  public function Feature()
  {
    return $this->belongsTo('App\Models\Feature', 'feature_id', 'id');
  }

  public function Room()
  {
    return $this->belongsTo('App\Models\Room', 'room_id', 'id');
  }


}
