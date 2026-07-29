<?php

namespace Modules\SocialSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SocialSupportWidgetSituationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('social_support_widget_situations')->delete();

        \DB::table('social_support_widget_situations')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Беременность и рождение ребенка',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Житель сельской местности - работник бюджетной сферы',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Наличие ребенка-инвалида',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Наличие тяжелых заболеваний',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Осуществление ухода за ребенком',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Пенсионер',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Пострадавший от радиации',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Семья военнослужащего',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Утрата близкого',
            ),
            9 =>
            array (
                'id' => 10,
            'name' => 'Обучение ребенка (детей) в школе',
            ),
        ));
        Schema::enableForeignKeyConstraints();

    }
}
