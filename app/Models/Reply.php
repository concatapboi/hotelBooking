<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  protected $table = 'reply';

  protected $fillable =[
    'content',
    'question_id',
    'hotel_id',
  ];
}
