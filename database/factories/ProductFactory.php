<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'code' => substr($faker->unique()->swiftBicNumber, 0, 6),
        'description' => $faker->realText('200'),
        'price' => $faker->randomNumber(5),
    ];
});
