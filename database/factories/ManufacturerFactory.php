<?php

use App\Manufacturer;
use Faker\Generator as Faker;

$factory->define(Manufacturer::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});
