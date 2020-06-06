<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product_Image extends Model
{
    protected $table ='product_images';
    protected $fillable = ['path','product_id'];
    public function products(){
    	return $this->belongsTo('App\Model\Products','product_id','id');
    }
    public $timestamps = false;
}
