<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ChatAnswerButtonTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('chat_answer_button_types')->delete();

        \DB::table('chat_answer_button_types')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => 'widget',
                'name' => 'Кнопка для открытия виджета',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'link',
                'name' => 'Ссылка',
            ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
