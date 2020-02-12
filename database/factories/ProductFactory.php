<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'code' => $faker->unique()->swiftBicNumber,
        'description' => $faker->realText('200'),
        'price' => $faker->randomFloat(2),
    ];
});
