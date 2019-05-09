<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  protected $table = 'booking';

  protected $fillable =[
    'hotel_name',
    'total_price',
    'contact_name',
    'contatc_email',
    'conact_phone',
    'contact_address',
    'special_request',
    'fax_number',
    'customer_id',
    'hotel_id',
    'payment_method_id',
    'status_id',
  ];
}
