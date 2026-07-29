<?php

namespace Modules\SocialSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class SocialSupportWidgetOdDatasetsTableSeeder extends Seeder
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
                    'url' => 'https://data.admhmao.ru/api/data/?id=2009568',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\SocialSupportWidget\\OpenDataHandlers\\SocialSupportSourceHandler',
                    'description' => 'Меры социальной поддержки',
                    'need_update' => 0,
                    'is_active' => 1,
                ],
        ];

        foreach ($data as $row) {
            if (\DB::table('social_support_widget_od_datasets')->where('id', $row['id'])->doesntExist()) {

                \DB::table('social_support_widget_od_datasets')->insert($row);
            }
        }
    }
}
