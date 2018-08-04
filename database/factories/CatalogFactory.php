<?php

use App\Catalog;
use Faker\Generator as Faker;

$factory->define(Catalog::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'name_ru' => $faker->name,
        'category_id' => rand(1, 10),
        'fullName' => $faker->name,
        'fullName_ru' => $faker->name,
        'status' => 'active',
    ];
});
