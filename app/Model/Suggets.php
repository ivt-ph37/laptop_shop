<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Suggets extends Model
{

    protected $table ='suggests';

    protected $fillable = ['user_id','username','email','telephone','name_product','quantity','status','content'];
    
    public function users(){
    	return $this->belongsTo('App\User','user_id','id');
    }
    
    public $timestamps = false;
}
