<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  protected $table = 'customer';
  protected $primaryKey = 'user_id';

  protected $fillable = [
    'user_id',
    'coint',
    'address',
  ];

  public function ofUser()
  {
    return $this->belongsTo('App\Models\User');
  }
}
