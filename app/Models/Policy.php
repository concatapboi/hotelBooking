<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
  protected $table = 'policy';

  protected $fillable =[
    'hotel_id',
    'check_in',
    'check_out',
    'can_refund',
    'content',
  ];
}
