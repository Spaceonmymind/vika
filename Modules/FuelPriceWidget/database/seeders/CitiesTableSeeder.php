<?php

namespace Modules\FuelPriceWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('fuel_price_widget_cities')->delete();

        \DB::table('fuel_price_widget_cities')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Кондинский район',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Лангепас',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Нефтеюганский район',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'Пыть-Ях',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Сургут',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'Ханты-Мансийский район',
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'Когалым',
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'Октябрьский район',
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'Покачи',
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'Белоярский район',
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'Березовский район',
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => 'Мегион',
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'Урай',
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'Югорск',
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'Сургутский район',
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'Советский район',
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'Нижневартовск',
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => 'Нижневартовский район',
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'Ханты-Мансийск',
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => 'Радужный',
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => 'Нягань',
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => 'Нефтеюганск',
                ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
