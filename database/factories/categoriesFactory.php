<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Categoies::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'parent_id' => $faker->randomDigit,
        'desription' => $faker->text,
    ];
});
