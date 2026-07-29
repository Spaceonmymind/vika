<?php

namespace Modules\SocialSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SocialSupportWidgetPreferentialCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();
        \DB::table('social_support_widget_preferential_categories')->delete();

        \DB::table('social_support_widget_preferential_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Ветеран ВОВ',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Ветеран военной службы',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Ветеран труда',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Житель блокадного Ленинграда, ставший инвалидом',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Инвалид ВОВ',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Лицо из числа КМНС',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Медаль или орден "Родительская слава"',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Многодетная семья',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Пострадавший от политических репрессий',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Почетный донор',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Реабилитированный',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Труженик тыла',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Узник фашизма',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Участник боевых действий',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Участник ВОВ',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Член семьи погибшего ветерана',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Инвалид',
            ),
        ));
        Schema::enableForeignKeyConstraints();

    }
}
