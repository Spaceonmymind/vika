<?php

namespace Modules\BusinessSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class BusinessSupportWidgetMunicipalitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if(\DB::table('business_support_widget_municipalities')->count() > 0){
            return;
        }
        \DB::table('business_support_widget_municipalities')->delete();

        \DB::table('business_support_widget_municipalities')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Нижневартовский район',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Советский район',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Кондинский район',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Октябрьский район',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Берёзовский район',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Сургутский район',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Ханты-Мансийск',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Белоярский район',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Мегион',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Нефтеюганский район',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Когалым',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Лангепас',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Нефтеюганск',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Нижневартовск',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Пыть-Ях',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Радужный',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Сургут',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Урай',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Югорск',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Нягань',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Покачи',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Ханты-Мансийский район',
            ),
        ));


    }
}
