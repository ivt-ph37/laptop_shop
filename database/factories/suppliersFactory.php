<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Suppliers::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'telephone' => $faker->phoneNumber,
        'address' => $faker->address,
		'email' => $faker->email ,
    ];
});
