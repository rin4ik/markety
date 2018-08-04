<?php

use App\Filter;
use Illuminate\Database\Seeder;

class FiltersTableSeeder extends Seeder
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
                'name' => 'Ishlab Chiqaruvchi',
                'name_ru' => 'Производитель',
                'type' => 'checkbox',
                'position' => 1,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/Apple=Apple', '2/Samsung=Samsung', '3/Lenovo=Lenovo', '4/Xiaomi=Xiaomi', '5/LG=LG']
            ],
            [
                'name' => 'Protsentsiz kredit',
                'name_ru' => 'Безпроцентный кредит',
                'type' => 'checkbox',
                'position' => 1,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/0% 24oyga=0% на 24месяцев', '2/0% 20oyga=0% на 20месяцев', '3/0% 16oyga=0% на 16месяцев', '4/0% 15oyga=0% на 10месяцев']
            ],
            [
                'name' => 'Sotuvchi',
                'name_ru' => 'Продавец',
                'type' => 'checkbox',
                'position' => 2,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/Rozetka=Rozetka', '2/Allo=Allo', '3/Price=Price']
            ],
            [
                'name' => 'Ekran diagonali',
                'name_ru' => 'Диагональ Экрана',
                'type' => 'checkbox',
                'position' => 2,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/4=4', '2/4.1-4.5=4.1-4.5', '3/4.5-5=5.1-5.5']
            ],
            [
                'name' => 'Batareya hajmi',
                'name_ru' => 'Емкость аккамулятора',
                'type' => 'checkbox',
                'position' => 3,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/2999 ma*s=2999 ма*ч', '2/3000-3999 ma*s=3000-3999_ма*ч', '3/4000ma*s=4000ма*ч']
            ],
            [
                'name' => 'Operativ xotira',
                'name_ru' => 'Оперативная память',
                'type' => 'checkbox',
                'position' => 1,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/2gb=2гб', '2/3gb=3гб', '3/4gb=4гб', '4/5gb=5гб']
            ],
            [
                'name' => 'Kamera',
                'name_ru' => 'Камера',
                'type' => 'checkbox',
                'position' => 2,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/12MP=12Мп', '2/13MP=13Мп', '3/16MP=16Мп', '4/20MP=20Мп'],
            ],
            [
                'name' => 'Ichki xotira',
                'name_ru' => 'Внутренная память',
                'type' => 'checkbox',
                'position' => 3,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/16gb=16гб', '2/32gb=32гб', '3/64gb=64гб', '4/128gb=128гб'],
            ],
            [
                'name' => 'Operatsion sistema',
                'name_ru' => 'Операционная система',
                'type' => 'radio',
                'position' => 1,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/IOS=IOS', '2/Android=Android', '3/Blackberry=BlackBerry'],
            ],
            [
                'name' => 'Rangi',
                'name_ru' => 'Цвет',
                'type' => 'checkbox',
                'position' => 2,
                'status' => 'active',
                'use' => 'Да',
                'list' => ['1/Qora=Черный', '2/Oltin=Золотой', '3/Sariq=Желтый', '4/Pushti=Розовый', '5/Yashil=Зеленый'],
            ]
        ])->each(function ($filter) {
            factory(Filter::class)->create(
                [
                    'name' => $filter['name'],
                    'name_ru' => $filter['name_ru'],
                    'type' => $filter['type'],
                    'position' => $filter['position'],
                    'status' => $filter['status'],
                    'use' => $filter['use'],
                    'list' => $filter['list'],
                ]
            );
        });
    }
}
