<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'fullname','email','level','telephone','sex','image'
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
    public function suggests(){
        return $this->hasMany('App\Model\Suggets','user_id','id');
    }
    public function orders(){
        return $this->hasMany('App\Model\Orders','user_id','id');
    }
    public function promotions(){
        return $this->hasMany('App\Model\Promotions','user_id','id');
    }
}
