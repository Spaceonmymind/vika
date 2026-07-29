<?php

namespace Modules\DistrictSearchWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictSearchWidgetAreaTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

       // \DB::table('district_search_widget_area_types')->delete();

        $data = [
            0 =>
                [
                    'id' => 1,
                    'code' => 'В',
                    'name' => 'Все',
                ],
            1 =>
                [
                    'id' => 2,
                    'code' => 'Ч',
                    'name' => 'Четные',
                ],
            2 =>
                [
                    'id' => 3,
                    'code' => 'Н',
                    'name' => 'Нечётные',
                ],
        ];

        foreach ($data as $row) {
            if (\DB::table('district_search_widget_area_types')->where('id', $row['id'])->doesntExist()) {

                \DB::table('district_search_widget_area_types')->insert($row);
            }
        }
    }
}
