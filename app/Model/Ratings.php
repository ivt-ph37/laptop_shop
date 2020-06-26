<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    protected $table ='ratings';

    protected $fillable = ['user_id','product_id','number_rating', 'content'];

    
}
