<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use App\Type;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $types = Type::all()->pluck('id')->toArray();

    return [
        'type_id' => $faker->randomElement($types),
        'name' => $faker->name,
        'year' => rand(1950, 2020),
        'duration' => rand(60,200),
        'rating' => rand(10, 50) / 10,
        'image' => $faker->imageUrl()
    ];
});
