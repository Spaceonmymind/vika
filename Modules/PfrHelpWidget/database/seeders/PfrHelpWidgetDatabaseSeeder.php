<?php

namespace Modules\PfrHelpWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PfrHelpWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PfrHelpWidgetServicesTableSeeder::class);
        $this->call(PfrHelpWidgetQuestionCategoriesTableSeeder::class);
        $this->call(PfrHelpWidgetQuestionsTableSeeder::class);
    }
}
