<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;

$factory->define(App\Model\Contacts::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'email' => $faker->email ,
        'telephone' => $faker->phoneNumber,
        'address' => $faker->address,
        'content' => $faker->text,
        'contact_date' => $faker->dateTime($max = 'now', $timezone = null),
    ];
});
