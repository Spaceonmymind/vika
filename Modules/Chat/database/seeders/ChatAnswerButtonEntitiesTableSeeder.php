<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatAnswerButtonEntitiesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if (\DB::table('chat_answer_button_entities')->exists()) {
            return;
        }


        \DB::table('chat_answer_button_entities')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'button_id' => 20,
                    'name' => 'Тип топлива',
                    'code' => 'fuel_type',
                    'param_name' => 'fuel_type_ids',
                    'multiple' => 1,
                    'table' => 'fuel_price_widget_fuel_types',
                    'search_column' => 'code',
                    'value_column' => 'id',
                    'created_at' => '2025-03-12 11:12:59',
                    'updated_at' => '2025-03-12 11:12:59',
                ),
            1 =>
                array(
                    'id' => 2,
                    'button_id' => 20,
                    'name' => 'Город',
                    'code' => 'city',
                    'param_name' => 'city_id',
                    'multiple' => 0,
                    'table' => 'fuel_price_widget_cities',
                    'search_column' => 'name',
                    'value_column' => 'id',
                    'created_at' => '2025-03-12 11:13:45',
                    'updated_at' => '2025-03-12 11:13:45',
                ),
            2 =>
                array(
                    'id' => 3,
                    'button_id' => 19,
                    'name' => 'Тип топлива',
                    'code' => 'fuel_type',
                    'param_name' => 'fuel_type_ids',
                    'multiple' => 1,
                    'table' => 'fuel_price_widget_fuel_types',
                    'search_column' => 'code',
                    'value_column' => 'id',
                    'created_at' => '2025-03-12 11:12:59',
                    'updated_at' => '2025-03-12 11:12:59',
                ),
            3 =>
                array(
                    'id' => 4,
                    'button_id' => 19,
                    'name' => 'Город',
                    'code' => 'city',
                    'param_name' => 'city_id',
                    'multiple' => 0,
                    'table' => 'fuel_price_widget_cities',
                    'search_column' => 'name',
                    'value_column' => 'id',
                    'created_at' => '2025-03-12 11:13:45',
                    'updated_at' => '2025-03-12 11:13:45',
                ),
        ));


    }
}
