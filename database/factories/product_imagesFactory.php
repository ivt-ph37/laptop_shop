<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Products;
use Faker\Generator as Faker;

$factory->define(App\Model\Product_Image::class, function (Faker $faker) {
	$list_pro_id=Products::pluck('id');
    return [
        'path' => $faker->imageUrl($width = 640, $height = 480),
        'product_id' => $faker->randomElement($list_pro_id),
    ];
});
