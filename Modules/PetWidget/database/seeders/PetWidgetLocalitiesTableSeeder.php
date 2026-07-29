<?php

namespace Modules\PetWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PetWidgetLocalitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pet_widget_localities')->delete();

        \DB::table('pet_widget_localities')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Белоярский',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Белоярский район',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Когалым',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Кондинский район',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Лангепас',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Покачи',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Мегион',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Нефтеюганск',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Пыть-Ях',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Нефтеюганский район',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Нижневартовск',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Нижневартовский район',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Нягань',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Октябрьский район',
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Радужный',
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Советский район',
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Сургут',
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Сургутский район',
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Урай',
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'Ханты-Мансийский район',
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Ханты-Мансийск',
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Югорск',
            ),
        ));


    }
}
