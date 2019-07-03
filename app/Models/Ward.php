<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
  protected $table = 'ward';

  protected $fillable =[
    'name',
    'district_id',
  ];
  public function Hotel()
  {
    return $this->hasMany("App\Models\Hotel","ward_id","id");
  }
}
