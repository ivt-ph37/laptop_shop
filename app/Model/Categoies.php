<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Categoies extends Model
{
	
    protected $table ='categories';

    protected $fillable = ['name','parent_id','desription'];

    public function products()
    {
    	return $this->hasMany('App\Model\Products','category_id','id');
    }

	public function categories()
	{
		return $this->hasMany(Categoies::class,'parent_id','id');
	}

	public function childrenCategories()
	{
	    return $this->hasMany(Categoies::class,'parent_id','id')->with('categories');
	}

    public $timestamps = false;
}
