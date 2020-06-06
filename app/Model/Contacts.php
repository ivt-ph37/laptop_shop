<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $table ='contacts';
    protected $fillable = ['fullname','email','telephone','address','content','contact_date'];
    public $timestamps = false;
}
