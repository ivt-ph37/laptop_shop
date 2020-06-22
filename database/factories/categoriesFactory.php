<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Categoies::class, function (Faker $faker) {
	$list_cate_id=App\Model\Categoies::pluck('id');
    return [
        'name' => $faker->name,
        'parent_id' => $faker->randomElement($list_cate_id),
        'desription' => $faker->text,
    ];
});
