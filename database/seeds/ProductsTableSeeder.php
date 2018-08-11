<?php

use App\Product;
use App\Manufacturer;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 15)->create();
        Manufacturer::get()->each(function ($manufacturer) {
            factory(Product::class, 10)->create([
                'category_id' => 11,
                'manufacturer_id' => $manufacturer->id
            ]);
        });
    }
}
