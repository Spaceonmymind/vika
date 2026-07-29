<?php

namespace Modules\KMNSSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class KmnsSupportWidgetOdDatasetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

       // \DB::table('kmns_support_widget_od_datasets')->delete();

        $data = [
            0 =>
                [
                    'id' => 1,
                    'url' => 'https://data.admhmao.ru/api/data/?id=10142109',
                    'data_type' => 'json',
                    'class_handler' => '\\Modules\\KMNSSupportWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'description' => 'Перечень государственных и муниципальных услуг, предназначенных для коренных малочисленных народов Севера',
                    'need_update' => 1,
                    'is_active' => 1,
                ],
        ];

        foreach ($data as $row) {
            if (\DB::table('kmns_support_widget_od_datasets')->where('id', $row['id'])->doesntExist()) {

                \DB::table('kmns_support_widget_od_datasets')->insert($row);
            }
        }
    }
}
