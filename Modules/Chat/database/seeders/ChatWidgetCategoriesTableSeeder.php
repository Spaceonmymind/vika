<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatWidgetCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if(\DB::table('chat_widget_categories')->exists()){
            return;
        }

        //\DB::table('chat_widget_categories')->delete();

        \DB::table('chat_widget_categories')->insert(array (
            0 =>
            array (
                'id' => 8,
                'name' => 'Меры поддержки',
                'description' => NULL,
                'icon_id' => 1,
                'vika_type_id' => 1,
                'order' => 1,
                'bg_colour' => '#236BD8',
                'is_favorite' => 0,
            ),
            1 =>
            array (
                'id' => 9,
                'name' => 'Образование',
                'description' => NULL,
                'icon_id' => 2,
                'vika_type_id' => 1,
                'order' => 2,
                'bg_colour' => '#D27EB1',
                'is_favorite' => 0,
            ),
            2 =>
            array (
                'id' => 10,
                'name' => 'Здравоохранение',
                'description' => NULL,
                'icon_id' => 23,
                'vika_type_id' => 1,
                'order' => 3,
                'bg_colour' => '#59C18F',
                'is_favorite' => 0,
            ),
            3 =>
            array (
                'id' => 11,
                'name' => 'Домашние животные',
                'description' => NULL,
                'icon_id' => 18,
                'vika_type_id' => 1,
                'order' => 4,
                'bg_colour' => '#6FA837',
                'is_favorite' => 1,
            ),
            4 =>
            array (
                'id' => 12,
                'name' => 'Культура',
                'description' => NULL,
                'icon_id' => 14,
                'vika_type_id' => 1,
                'order' => 5,
                'bg_colour' => '#6FC9E5',
                'is_favorite' => 0,
            ),
            5 =>
            array (
                'id' => 13,
                'name' => 'В помощь мигранту',
                'description' => NULL,
                'icon_id' => 9,
                'vika_type_id' => 1,
                'order' => 6,
                'bg_colour' => '#511C7B',
                'is_favorite' => 0,
            ),
            6 =>
            array (
                'id' => 14,
                'name' => 'Справка',
                'description' => NULL,
                'icon_id' => 1,
                'vika_type_id' => 1,
                'order' => 7,
                'bg_colour' => '#EFE375',
                'is_favorite' => 0,
            ),
            7 =>
            array (
                'id' => 15,
                'name' => 'Прочее',
                'description' => NULL,
                'icon_id' => 24,
                'vika_type_id' => 1,
                'order' => 8,
                'bg_colour' => '#70ACCD',
                'is_favorite' => 0,
            ),
        ));


    }
}
