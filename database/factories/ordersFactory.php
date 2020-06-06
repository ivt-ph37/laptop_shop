<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Model\Orders::class, function (Faker $faker) {
	$list_user_id=User::pluck('id');
    return [
        'user_id' => $faker->randomElement($list_user_id),
        'username' => $faker->name ,
        'email' => $faker->email,
        'telephone' => $faker->phoneNumber,
        'order_date' => $faker->dateTime($max = 'now', $timezone = null),
        'delivery_date' => $faker->dateTime($max = 'now', $timezone = null),
        'deliver_status' => $faker->word,
        'payment_date' => $faker->dateTime($max = 'now', $timezone = null),
        'delivery_address' => $faker->word,
    ];
});
