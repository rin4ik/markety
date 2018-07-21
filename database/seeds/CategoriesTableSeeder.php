<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        collect([
            [
                'name' => 'Электроника',
                'name_ru' => 'Электроника',
            ],
            [
                'name' => 'Компьютер техника',
                'name_ru' => 'Компьютерная техника',
            ],
            [
                'name' => 'Хожалик моллари',
                'name_ru' => 'Бытовая техника',
            ],
            [
                'name' => 'Авто и мото',
                'name_ru' => 'Авто и мото',
            ],
            [
                'name' => 'Кийим ва пойафзал',
                'name_ru' => 'Одежда и обувь',
            ],
            [
                'name' => 'Уй ва дача учун',
                'name_ru' => 'Для дома и дачи',
            ],
            [
                'name' => 'Гузалик ва Саломатлик',
                'name_ru' => 'Красота и здоровье',
            ],
            [
                'name' => 'Болалар товарлари',
                'name_ru' => 'Детские товары',
            ],
            [
                'name' => 'Ремонт ва Курилиш',
                'name_ru' => 'Ремонт и строительство',
            ],
            [
                'name' => 'Озик-овкат',
                'name_ru' => 'Продукты',
            ],
            [
                'name' => 'Спорт ва дам',
                'name_ru' => 'Спорт и отдых',
            ],
            [
                'name' => 'Хайвонлар учун товарлар',
                'name_ru' => 'Товары для животных',
            ],
            [
                'name' => 'Хордик ва дам олиш',
                'name_ru' => 'Досуг и развлечения',
            ],
        ])->each(function ($category) {
            factory(Category::class)->create(
                [
                    'name' => $category['name'],
                    'name_ru' => $category['name_ru'],
                ]
            );
        });
    }
}
