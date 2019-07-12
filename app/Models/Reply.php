<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
  protected $table = 'reply';

  protected $fillable = [
    'content',
    'question_id',
  ];

  public function Question()
  {
    return $this->belongsTo('App\Models\Question', 'question_id', 'id');
  }
}
