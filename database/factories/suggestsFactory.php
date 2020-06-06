<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Model\Suggets::class, function (Faker $faker) {
	$list_user_id=User::pluck('id');
    return [
        'user_id' => $faker->randomElement($list_user_id),
        'username' => $faker->name ,
        'email' => $faker->email,
        'telephone' => $faker->phoneNumber,
        'name_product' => $faker->name,
        'quantity' => $faker->randomDigit,
        'content' => $faker->text,
    ];
});
