<?php

namespace Modules\SocialSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class SocialSupportWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(SocialSupportWidgetOdDatasetsTableSeeder::class);
        $this->call(SocialSupportWidgetPreferentialCategoriesTableSeeder::class);
        $this->call(SocialSupportWidgetSituationsTableSeeder::class);
    }
}
