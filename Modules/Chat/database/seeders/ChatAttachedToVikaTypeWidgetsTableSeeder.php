<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatAttachedToVikaTypeWidgetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        if(\DB::table('chat_attached_to_vika_type_widgets')->exists()){
            return;
        }

        //\DB::table('chat_attached_to_vika_type_widgets')->delete();

        \DB::table('chat_attached_to_vika_type_widgets')->insert(array (
            0 =>
                array (
                    'id' => 39,
                    'chat_widget_id' => 1,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 4,
                    'is_favorite' => 1,
                ),
            1 =>
                array (
                    'id' => 40,
                    'chat_widget_id' => 2,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 2,
                    'is_favorite' => 1,
                ),
            2 =>
                array (
                    'id' => 41,
                    'chat_widget_id' => 4,
                    'vika_type_id' => 1,
                    'category_id' => 8,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            3 =>
                array (
                    'id' => 42,
                    'chat_widget_id' => 5,
                    'vika_type_id' => 1,
                    'category_id' => 9,
                    'order' => 2,
                    'is_favorite' => 1,
                ),
            4 =>
                array (
                    'id' => 43,
                    'chat_widget_id' => 7,
                    'vika_type_id' => 1,
                    'category_id' => 13,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            5 =>
                array (
                    'id' => 44,
                    'chat_widget_id' => 8,
                    'vika_type_id' => 1,
                    'category_id' => 10,
                    'order' => 1,
                    'is_favorite' => 1,
                ),
            6 =>
                array (
                    'id' => 45,
                    'chat_widget_id' => 10,
                    'vika_type_id' => 1,
                    'category_id' => 8,
                    'order' => 2,
                    'is_favorite' => 0,
                ),
            7 =>
                array (
                    'id' => 46,
                    'chat_widget_id' => 11,
                    'vika_type_id' => 1,
                    'category_id' => 9,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            8 =>
                array (
                    'id' => 47,
                    'chat_widget_id' => 12,
                    'vika_type_id' => 1,
                    'category_id' => 8,
                    'order' => 6,
                    'is_favorite' => 0,
                ),
            9 =>
                array (
                    'id' => 48,
                    'chat_widget_id' => 13,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 5,
                    'is_favorite' => 0,
                ),
            10 =>
                array (
                    'id' => 49,
                    'chat_widget_id' => 14,
                    'vika_type_id' => 1,
                    'category_id' => 8,
                    'order' => 4,
                    'is_favorite' => 0,
                ),
            11 =>
                array (
                    'id' => 50,
                    'chat_widget_id' => 15,
                    'vika_type_id' => 1,
                    'category_id' => 12,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            12 =>
                array (
                    'id' => 51,
                    'chat_widget_id' => 16,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            13 =>
                array (
                    'id' => 52,
                    'chat_widget_id' => 17,
                    'vika_type_id' => 1,
                    'category_id' => 12,
                    'order' => 2,
                    'is_favorite' => 0,
                ),
            14 =>
                array (
                    'id' => 53,
                    'chat_widget_id' => 19,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 8,
                    'is_favorite' => 0,
                ),
            15 =>
                array (
                    'id' => 54,
                    'chat_widget_id' => 20,
                    'vika_type_id' => 1,
                    'category_id' => 14,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            16 =>
                array (
                    'id' => 55,
                    'chat_widget_id' => 21,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 7,
                    'is_favorite' => 0,
                ),
            17 =>
                array (
                    'id' => 56,
                    'chat_widget_id' => 22,
                    'vika_type_id' => 1,
                    'category_id' => 11,
                    'order' => 1,
                    'is_favorite' => 0,
                ),
            18 =>
                array (
                    'id' => 57,
                    'chat_widget_id' => 23,
                    'vika_type_id' => 1,
                    'category_id' => 11,
                    'order' => 2,
                    'is_favorite' => 0,
                ),
            19 =>
                array (
                    'id' => 58,
                    'chat_widget_id' => 24,
                    'vika_type_id' => 1,
                    'category_id' => 11,
                    'order' => 3,
                    'is_favorite' => 0,
                ),
            20 =>
                array (
                    'id' => 59,
                    'chat_widget_id' => 25,
                    'vika_type_id' => 1,
                    'category_id' => 8,
                    'order' => 5,
                    'is_favorite' => 0,
                ),
            21 =>
                array (
                    'id' => 60,
                    'chat_widget_id' => 27,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 9,
                    'is_favorite' => 0,
                ),
            22 =>
                array (
                    'id' => 61,
                    'chat_widget_id' => 28,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 6,
                    'is_favorite' => 0,
                ),
            23 =>
                array (
                    'id' => 62,
                    'chat_widget_id' => 30,
                    'vika_type_id' => 1,
                    'category_id' => 8,
                    'order' => 7,
                    'is_favorite' => 0,
                ),
            24 =>
                array (
                    'id' => 63,
                    'chat_widget_id' => 31,
                    'vika_type_id' => 1,
                    'category_id' => 11,
                    'order' => 4,
                    'is_favorite' => 0,
                ),
            25 =>
                array (
                    'id' => 64,
                    'chat_widget_id' => 32,
                    'vika_type_id' => 1,
                    'category_id' => 11,
                    'order' => 5,
                    'is_favorite' => 0,
                ),
            26 =>
                array (
                    'id' => 65,
                    'chat_widget_id' => 33,
                    'vika_type_id' => 1,
                    'category_id' => 13,
                    'order' => 2,
                    'is_favorite' => 0,
                ),
            27 =>
                array (
                    'id' => 66,
                    'chat_widget_id' => 34,
                    'vika_type_id' => 1,
                    'category_id' => 13,
                    'order' => 3,
                    'is_favorite' => 0,
                ),
            28 =>
                array (
                    'id' => 67,
                    'chat_widget_id' => 35,
                    'vika_type_id' => 1,
                    'category_id' => 13,
                    'order' => 4,
                    'is_favorite' => 0,
                ),
            29 =>
                array (
                    'id' => 68,
                    'chat_widget_id' => 36,
                    'vika_type_id' => 1,
                    'category_id' => 13,
                    'order' => 5,
                    'is_favorite' => 0,
                ),
            30 =>
                array (
                    'id' => 69,
                    'chat_widget_id' => 42,
                    'vika_type_id' => 1,
                    'category_id' => 15,
                    'order' => 3,
                    'is_favorite' => 0,
                ),
        ));


    }
}
