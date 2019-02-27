<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
    return [
        'isbn' => $faker->isbn13,
        'title' => $faker->title,
        'author' => $faker->name,
        'price' => $faker->randomFloat(1, 0, 100),
    ];
});
