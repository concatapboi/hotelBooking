<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comment';

  protected $fillable =[
    'customer_id',
    'review_id',
    'content',
  ];
}
