<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Promotions extends Model
{

    protected $table ='promotions';
<<<<<<< HEAD

    protected $fillable = [
    	'user_id','product_id','price','quantity','start_date','end_date'
    ];

    public function products()
    {
=======
    protected $fillable = ['user_id','product_id','price','quantity','start_date','end_date','status'];
    public function products(){
>>>>>>> 7fc0e8b... dung
    	return $this->belongsTo('App\Model\Products','product_id','id');
    }

    public function users()
    {
    	return $this->belongsTo('App\User','user_id','id');
    }
<<<<<<< HEAD
    
=======
    public function getExpiredAttribute(){
    	//dd(date('Y-m-d'), $this->end_date);
    	return date('Y-m-d') > $this->end_date ? true : false;	
    }
>>>>>>> 7fc0e8b... dung
    public $timestamps = false;
}
