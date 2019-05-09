<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerFollowing extends Model
{
  protected $table = 'customer_following';

  protected $fillable =[
    'follower_id',
    'followed_id',
  ];
}
