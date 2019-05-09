<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  protected $table = 'hotel';

  protected $fillable =[
    'verified',
    'credit_card',
    'rank_point',
    'name',
    'meta_name',
    'tax_code',
    'review_point',
    'fax_number',
    'coint',
    'hotel_type_id',
    'hotel_manager_id',
  ];
}
