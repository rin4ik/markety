<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CatalogsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ManufacturersTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(FiltersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
