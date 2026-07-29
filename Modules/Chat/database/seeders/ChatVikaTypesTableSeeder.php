<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatVikaTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        $data =array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'main',
                    'description' => 'Основной чат',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'dit',
                    'description' => 'Чат у Департамента ИТ',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'goszakupki',
                    'description' => 'Чат для департамента госзакупок',
                ),
        );
        foreach ($data as $row){
            if(\DB::table('chat_vika_types')->where('id',$row['id'])->doesntExist()){

                \DB::table('chat_vika_types')->insert($row);
            }
        }

    }
}
