<?php

use App\Filter;
use App\Product;
use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Category::class, 10)->create()->each(function ($category) {
            factory(Filter::class, 10)->create([
                'category_id' => $category->id
            ]);
            factory(Product::class, 10)->create([
                'category_id' => $category->id
            ]);
        });
        ;
    }
}
