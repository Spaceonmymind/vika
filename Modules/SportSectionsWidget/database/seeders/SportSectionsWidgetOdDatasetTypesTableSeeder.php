<?php

namespace Modules\SportSectionsWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SportSectionsWidgetOdDatasetTypesTableSeeder extends Seeder
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
                    'code' => 'sport_organisations',
                    'name' => 'Спортивные организации',
                ),
            1 =>
                array(
                    'id' => 2,
                    'code' => 'sport_trainers',
                    'name' => 'Спортивные тренеры',
                ),
            2 =>
                array(
                    'id' => 3,
                    'code' => 'sport_sections',
                    'name' => 'Спортивные секции',
                ),
        );
        foreach ($data as $row) {
            if (DB::table('sport_sections_widget_od_dataset_types')->where('id', $row['id'])->doesntExist()) {

                DB::table('sport_sections_widget_od_dataset_types')->insert($row);
            }
        }
    }
}
