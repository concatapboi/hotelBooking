<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
  protected $table = 'policy';

  protected $fillable = [
    'hotel_id',
    'payment_method',
    'check_in',
    'check_out',
    'cancelable',
    'can_refund',
    'cancelable',
    'content',
    'payment_method',
  ];

  public function Hotel()
  {
    return $this->belongsTo('App\Models\Hotel', 'hotel_id', 'id');
  }
}
