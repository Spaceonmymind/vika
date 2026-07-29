<?php

namespace Modules\GosZakupkiWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class GosZakupkiWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->call(GosZakupkiWidgetQuestionCategoriesTableSeeder::class);
        $this->call(GosZakupkiWidgetQuestionsTableSeeder::class);
    }
}
