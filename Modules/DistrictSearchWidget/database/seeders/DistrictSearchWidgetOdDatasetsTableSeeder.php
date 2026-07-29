<?php

namespace Modules\DistrictSearchWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictSearchWidgetOdDatasetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        //\DB::table('district_search_widget_od_datasets')->delete();

        $data = [
            0 =>
                [
                    'id' => 1,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2130288',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\DistrictSearchWidget\\OpenDataHandlers\\HospitalsSourceHandler',
                    'description' => 'Данные учреждений здравоохранения в Ханты-Мансийском автономном округе – Югре',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => null,
                    'last_update' => null,
                    'dataset_type_id' => 1,
                ],
            1 =>
                [
                    'id' => 2,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2124338',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\DistrictSearchWidget\\OpenDataHandlers\\DistrictsSourceHandler',
                    'description' => 'Данные об участках объектов здравоохранения в Ханты-Мансийском автономном округе – Югре',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => null,
                    'last_update' => null,
                    'dataset_type_id' => 3,
                ],
            2 =>
                [
                    'id' => 3,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2284233',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\DistrictSearchWidget\\OpenDataHandlers\\DoctorsSourceHandler',
                    'description' => 'Данные об участковых врачах объектов здравоохранения в Ханты-Мансийском автономном округе – Югре',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => null,
                    'last_update' => null,
                    'dataset_type_id' => 2,
                ],
        ];
        foreach ($data as $row){
            if(\DB::table('district_search_widget_od_datasets')->where('id',$row['id'])->doesntExist()){

                \DB::table('district_search_widget_od_datasets')->insert($row);
            }
        }
    }
}
