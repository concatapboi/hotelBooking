<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
  protected $table = 'policy';

  protected $fillable = [
    'hotel_id',
    'check_in',
    'check_out',
    'cancelable',
    'can_refund',
    'cancelable',
    'content',
  ];

  public function Hotel()
  {
    return $this->belongsTo('App\Models\Hotel', 'hotel_id', 'id');
  }
}
