<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table ='suppliers';

    protected $fillable = [
    	'name','telephone','address','email'
    ];

    public function products()
    {
    	return $this->hasMany('App\Model\Products','supplier_id','id');
    }
    
    public $timestamps = false;
}
