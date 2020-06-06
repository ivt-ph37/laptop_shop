<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    protected $table ='order_details';
    protected $fillable = ['order_id','product_id','price','quantity'];
    public function products(){
    	return $this->belongsTo('App\Model\Products','product_id','id');
    }
    public function orders(){
    	return $this->belongsTo('App\Model\Orders','order_id','id');
    }
    public $timestamps = false;
}
