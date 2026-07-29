<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatAnswerVikaTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('chat_answer_vika_type')->delete();

        \DB::table('chat_answer_vika_type')->insert(array (
            0 =>
            array (
                'chat_answer_id' => 1,
                'vika_type_id' => 1,
            ),
            1 =>
            array (
                'chat_answer_id' => 1,
                'vika_type_id' => 2,
            ),
            2 =>
            array (
                'chat_answer_id' => 1,
                'vika_type_id' => 3,
            ),
            3 =>
            array (
                'chat_answer_id' => 2,
                'vika_type_id' => 1,
            ),
        ));


    }
}
