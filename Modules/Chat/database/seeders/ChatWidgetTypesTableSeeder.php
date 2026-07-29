<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatWidgetTypesTableSeeder extends Seeder
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
                'code' => 'internal',
                'name' => 'Внутренний',
            ],
            [
                'id' => 2,
                'code' => 'link',
                'name' => 'Ссылочный',
            ],
        ];
        foreach ($data as $row) {
            if (\DB::table('chat_widget_types')->where('id', $row['id'])->doesntExist()) {

                \DB::table('chat_widget_types')->insert($row);
            }
        }

    }
}
