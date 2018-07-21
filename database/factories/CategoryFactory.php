<?php

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'name_ru' => $faker->name,
        'fullName' => $faker->name,
        'fullName_ru' => $faker->name,
        'status' => 'active'
    ];
});
