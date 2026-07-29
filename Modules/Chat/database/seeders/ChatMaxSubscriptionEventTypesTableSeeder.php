<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatMaxSubscriptionEventTypesTableSeeder extends Seeder
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
                'code' => 'actirovki',
                'description' => 'Уведомления об действующих актировках',
            ],
            [
                'id' => 2,
                'code' => 'hospital_notifications',
                'description' => 'Уведомления о талонах на приём к врачу',
            ],
        ];
        foreach ($data as $row) {
            if (\DB::table('chat_max_subscription_event_types')->where('id', $row['id'])->doesntExist()) {

                \DB::table('chat_max_subscription_event_types')->insert($row);
            }
        }

    }
}
