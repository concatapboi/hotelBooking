<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\HotelManager;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function HotelManager(){
        return $this->hasMany('App\Models\HotelManager','user_id','id');
    }
    public function getCustomer(){
     return $this->belongsTo('App\Models\Customer','id','user_id');
    }

    public function Booking(){
     return $this->hasMany('App\Models\Booking','customer_id','id');
    }

    public function isHotelManager(){
      foreach ( $this->HotelManager as $key => $value) {
        return true;
      }
      return false;
    }

    public function isCustomer(){
      foreach ( $this->getCustomer as $key => $value) {
        return true;
      }
      return false;
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
