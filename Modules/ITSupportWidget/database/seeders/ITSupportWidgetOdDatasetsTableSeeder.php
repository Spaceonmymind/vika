<?php

namespace Modules\ITSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class ITSupportWidgetOdDatasetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $data = [
            0 =>
                [
                    'id' => 1,
                    'url' => 'https://data.admhmao.ru/api/data/?id=7301047',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\ITSupportWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'description' => 'Поддержка ИТ-компаний',
                    'need_update' => 0,
                    'is_active' => 1,
                ],
        ];

        foreach ($data as $row) {
            if (\DB::table('it_support_widget_od_datasets')->where('id', $row['id'])->doesntExist()) {

                \DB::table('it_support_widget_od_datasets')->insert($row);
            }
        }

    }
}
