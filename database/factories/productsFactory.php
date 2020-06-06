<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Categoies;
use App\Model\Suppliers;
use Faker\Generator as Faker;

$factory->define(App\Model\Products::class, function (Faker $faker) {
	$list_cate_id=Categoies::pluck('id');
	$list_supp_id=Suppliers::pluck('id');
    return [
        'name' => $faker->name,
        'quantity' => $faker->randomDigit ,
        'price' => $faker->randomDigit,
        'supplier_id' => $faker->randomElement($list_supp_id),
        'category_id' => $faker->randomElement($list_cate_id),
        'RAM' => $faker->word,
        'VGA' => $faker->word,
        'operating_system' => $faker->word ,
        'CPU' => $faker->word,
        'guarantee' => $faker->word,
        'note' => $faker->text,
        'description' => $faker->text,
        'sales_volume' => $faker->randomDigit,
    ];
});
