<?php

use App\Filter;
use Faker\Generator as Faker;

$factory->define(Filter::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'name_ru' => $faker->word,
        'type' => 'checkbox',
        'status' => 'active',
        'category_id' => rand(1, 10),
        'list' => ['1/Apple=Apple', '2/Samsung=Samsung', '3/Lenovo=Lenovo', '4/Xiaomi=Xiaomi', '5/LG=LG'],
        'position' => rand(1, 10),
        'use' => 'Да'
    ];
});
