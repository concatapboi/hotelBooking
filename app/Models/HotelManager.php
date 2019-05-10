<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelManager extends Model
{
	protected $table = 'hotel_manager';

	protected $primaryKey = "user_id";

	protected $fillable =[
	  'user_id',
	];

	public function User(){
		return $this->belongsTo('App\Models\User');
	}
}
