<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table ='orders';
    protected $fillable = ['user_id','username','email','telephone','order_date','delivery_date','deliver_status','payment_date','delivery_address'];
    public function order_detail(){
    	return $this->hasMany('App\Model\Order_Detail','order_id','id');
    }
    public function users(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    public $timestamps = false;
}
