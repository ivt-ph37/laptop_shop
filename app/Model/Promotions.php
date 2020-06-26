<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{

    protected $table ='promotions';

    protected $fillable = ['user_id','product_id','price','quantity','start_date','end_date','status'];

    public function products(){

    	return $this->belongsTo('App\Model\Products','product_id','id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }

    public function getExpiredAttribute(){
    	//dd(date('Y-m-d'), $this->end_date);
    	return date('Y-m-d') > $this->end_date ? true : false;	
    }

    public $timestamps = false;
}
