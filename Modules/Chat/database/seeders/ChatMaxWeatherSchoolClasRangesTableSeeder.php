<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatMaxWeatherSchoolClasRangesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'id' => 1,
                'code' => 'from_1_to_4',
                'name' => 'с 1 по 4 класс',
                'description' => 'Актировки для учеников с 1 по 4 класс',
                'max_class' => 4,
            ],
            [
                'id' => 2,
                'code' => 'from_1_to_8',
                'name' => 'с 1 по 8 класс',
                'description' => 'Актировки для учеников с 1 по 8 класс',
                'max_class' => 8,
            ],
            [
                'id' => 3,
                'code' => 'from_1_to_11',
                'name' => 'с 1 по 11 класс',
                'description' => 'Актировки для учеников с 1 по 11 класс',
                'max_class' => 11,
            ],

        ];
        foreach ($data as $row) {
            if (\DB::table('chat_max_weather_school_class_ranges')->where('id', $row['id'])->doesntExist()) {

                \DB::table('chat_max_weather_school_class_ranges')->insert($row);
            }
        }

    }
}
