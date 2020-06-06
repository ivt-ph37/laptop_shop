<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Orders;
use App\Model\Products;
use Faker\Generator as Faker;

$factory->define(App\Model\Order_Detail::class, function (Faker $faker) {
	$list_order_id=Orders::pluck('id');
	$list_pro_id=Products::pluck('id');
    return [
        'order_id' => $faker->randomElement($list_order_id),
        'product_id' => $faker->randomElement($list_pro_id) ,
        'price' => $faker->randomDigit,
        'quantity' => $faker->randomDigit,
    ];
});
