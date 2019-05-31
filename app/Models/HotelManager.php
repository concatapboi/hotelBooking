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
	public function Hotel(){
		return $this->hasMany('App\Models\Hotel','hotel_manager_id','user_id');
	}
}
