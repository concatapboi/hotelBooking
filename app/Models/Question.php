<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $table = 'question';

  protected $fillable =[
    'title',
    'content',
    'customer_id',
    'hotel_id',
  ];
}
