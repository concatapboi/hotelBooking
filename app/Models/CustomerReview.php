<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerReview extends Model
{
  protected $table = 'customer_review';

  protected $fillable = [
    'id',
    'customer_id',
    'review_id',
    'status',
    'like',
    'useful',
  ];

  public function Customer()
  {
    return $this->belongsTo('App\Models\User', 'customer_id', 'id');
  }

  public function Review()
  {
    return $this->belongsTo('App\Models\Review', 'review_id', 'id');
  }
}
