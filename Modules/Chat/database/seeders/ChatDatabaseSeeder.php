<?php

namespace Modules\Chat\Database\Seeders;

use Illuminate\Database\Seeder;

class ChatDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(ChatVikaTypesTableSeeder::class);
        $this->call(ChatWidgetIconsTableSeeder::class);
        $this->call(ChatWidgetTypesTableSeeder::class);
        $this->call(ChatWidgetsTableSeeder::class);
        $this->call(ChatWidgetCategoriesTableSeeder::class);
        $this->call(ChatAttachedToVikaTypeWidgetsTableSeeder::class);
        //$this->call(ChatWidgetVikaTypeTableSeeder::class);

        $this->call(ChatAnswerButtonTypesTableSeeder::class);
        $this->call(ChatIntentHandlersTableSeeder::class);
        $this->call(ChatIntentsTableSeeder::class);
        $this->call(ChatAnswersTableSeeder::class);
        $this->call(ChatAnswerTextsTableSeeder::class);
        $this->call(ChatAnswerButtonsTableSeeder::class);
        $this->call(ChatAnswerButtonEntitiesTableSeeder::class);
        //$this->call(ChatAnswerVikaTypeTableSeeder::class);
        $this->call(ChatHintsTableSeeder::class);
        $this->call(ChatHintVikaTypeTableSeeder::class);
        $this->call(ChatMaxSubscriptionEventTypesTableSeeder::class);
        $this->call(ChatMaxWeatherSchoolClasRangesTableSeeder::class);
    }
}
