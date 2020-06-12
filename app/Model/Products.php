<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $table ='products';

    protected $fillable = [
        'name','quantity','price','supplier_id','category_id','RAM','VGA','operating_system','CPU','guarantee','note','description','sales_volume'
    ];

    public function categoies()
    {
    	return $this->belongsTo('App\Model\Categoies','category_id','id');
    }

    public function suppliers()
    {
    	return $this->belongsTo('App\Model\Suppliers','supplier_id','id');
    }

    public function order_detail()
    {
    	return $this->hasMany('App\Model\Order_Detail','product_id','id');
    }

    public function promotions()
    {
    	return $this->hasMany('App\Model\Promotions','product_id','id');
    }

    public function product_images()
    {
        return $this->hasMany('App\Model\Product_Image','product_id','id');
    }
    
    public $timestamps = false;
}
