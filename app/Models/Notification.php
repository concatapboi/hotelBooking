<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  protected $table = 'notification';

  protected $fillable =[
    'customer_id',
    'review_id',
    'status',
  ];
}
