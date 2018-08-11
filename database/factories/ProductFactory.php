<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => rand(1, 10),
        'manufacturer_id' => rand(1, 10),
        'model' => 'IPhone 6',
        'list' => 'asdsadasd'
    ];
});
