<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {

//    $hours = intval(rand(1,3));
//    $minutes = intval(rand(1, 59));

    return [
//        'type_id' => $faker->randomElement($types),
//        'imdb_id' => 'tt0286716',
//        'title' => $faker->name,
//        'year' => rand(1950, 2020),
//        'duration' => $hours . 'h ' . $minutes . 'm',
//        'plot' => $faker->realText(200),
//        'rating' => rand(10, 50) / 10,
//        'image' => $faker->imageUrl()
    ];
});
