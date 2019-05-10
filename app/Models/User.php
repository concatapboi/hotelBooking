<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\HotelManager;

class User extends Authenticatable
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
     return $this->hasMany('App\Models\Customer','user_id','id');
    }

    public function isHotelManager(){
      foreach ( $this->getHotelManager as $key => $value) {
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

}
