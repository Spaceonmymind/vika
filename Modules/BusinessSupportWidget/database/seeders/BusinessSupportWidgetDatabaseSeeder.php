<?php

namespace Modules\BusinessSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class BusinessSupportWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(BusinessSupportWidgetMunicipalitiesTableSeeder::class);
        $this->call(BusinessSupportWidgetOdDatasetsTableSeeder::class);
    }
}
