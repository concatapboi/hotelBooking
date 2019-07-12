<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
  protected $table = 'user_image';

  protected $fillable = [
    'image_link',
    'is_primary',
    'name',
    'user_id',
  ];

  public function User()
  {
    return $this->belongsTo('App\Models\User', 'user_id', 'id');
  }
}
