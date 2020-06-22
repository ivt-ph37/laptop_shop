<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Suggets extends Model
{

    protected $table ='suggests';
<<<<<<< HEAD

    protected $fillable = [
    	'user_id','username','email','telephone','name_product','quantity','content'
    ];

    public function users()
    {
=======
    protected $fillable = ['user_id','username','email','telephone','name_product','quantity','status','content'];
    public function users(){
>>>>>>> 7fc0e8b... dung
    	return $this->belongsTo('App\User','user_id','id');
    }
    
    public $timestamps = false;
}
