<?php

namespace Modules\SportSectionsWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportSectionsWidgetOdDatasetMunicipalitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'Кондинский район',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'Белоярский район',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'Берёзовский район',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'г. Лангепас',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'г. Мегион',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'г. Покачи',
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'г. Пыть-Ях',
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'г. Радужный',
                ),
            8 =>
                array(
                    'id' => 9,
                    'name' => 'г. Сургут',
                ),
            9 =>
                array(
                    'id' => 10,
                    'name' => 'г. Урай',
                ),
            10 =>
                array(
                    'id' => 11,
                    'name' => 'г. Ханты-Мансийск',
                ),
            11 =>
                array(
                    'id' => 12,
                    'name' => 'г. Югорск',
                ),
            12 =>
                array(
                    'id' => 13,
                    'name' => 'Нижневартовский район',
                ),
            13 =>
                array(
                    'id' => 14,
                    'name' => 'Октябрьский район',
                ),
            14 =>
                array(
                    'id' => 15,
                    'name' => 'Ханты-Мансийский район',
                ),
            15 =>
                array(
                    'id' => 16,
                    'name' => 'г. Нижневартовск',
                ),
            16 =>
                array(
                    'id' => 17,
                    'name' => 'г. Советский',
                ),
            17 =>
                array(
                    'id' => 18,
                    'name' => 'Сургутский район',
                ),
            18 =>
                array(
                    'id' => 19,
                    'name' => 'г. Нефтеюганск',
                ),
            19 =>
                array(
                    'id' => 20,
                    'name' => 'г. Когалым',
                ),
            20 =>
                array(
                    'id' => 21,
                    'name' => 'Нефтеюганский район',
                ),
            21 =>
                array(
                    'id' => 22,
                    'name' => 'г. Нягань',
                ),
        );
        foreach ($data as $row) {
            if (DB::table('sport_sections_widget_municipalities')->where('id', $row['id'])->doesntExist()) {

                DB::table('sport_sections_widget_municipalities')->insert($row);
            }
        }
    }
}
