<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Model\Products;
use Faker\Generator as Faker;

$factory->define(App\Model\Promotions::class, function (Faker $faker) {
	$list_user_id=User::pluck('id');
	$list_pro_id=Products::pluck('id');
    return [
        'user_id' => $faker->randomElement($list_user_id),
        'product_id' => $faker->randomElement($list_pro_id) ,
        'price' => $faker->randomDigit,
        'quantity' => $faker->randomDigit,
        'start_date' => $faker->dateTime($max = 'now', $timezone = null),
        'end_date' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});
