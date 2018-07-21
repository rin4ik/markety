<?php

use App\Manufacturer;
use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'Apple',
            ],
            [
                'name' => 'Samsung',
            ],
            [
                'name' => 'Lenovo',
            ],
            [
                'name' => 'Xiaomi',
            ],
            [
                'name' => 'Meize',
            ],
            [
                'name' => 'Nokia',
            ],
            [
                'name' => 'Huawei',
            ],
            [
                'name' => 'Sony',
            ],
            [
                'name' => 'Motorolla',
            ],
            [
                'name' => 'Blackview',
            ],
            [
                'name' => 'Alcatel',
            ],
            [
                'name' => 'Artel',
            ],
            [
                'name' => 'Doogee',
            ],
        ])->each(function ($manufacturer) {
            factory(Manufacturer::class)->create(
                [
                    'name' => $manufacturer['name'],
                ]
            );
        });
    }
}
