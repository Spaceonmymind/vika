<?php

namespace Modules\EmploymentUgraWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class EmploymentUgraWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(EmploymentUgraWidgetCategoriesTableSeeder::class);
        $this->call(EmploymentUgraWidgetQuestionsTableSeeder::class);
    }
}
