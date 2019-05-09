<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $table = 'review';

  protected $fillable =[
    'title',
    'content',
    'useful_point',
    'customer_id',
    'hotel_id'
  ];
}
