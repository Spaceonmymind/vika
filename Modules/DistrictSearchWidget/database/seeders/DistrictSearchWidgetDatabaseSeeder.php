<?php

namespace Modules\DistrictSearchWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictSearchWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(DistrictSearchWidgetAreaTypesTableSeeder::class);
        $this->call(DistrictSearchWidgetOdDatasetTypesTableSeeder::class);
        $this->call(DistrictSearchWidgetOdDatasetsTableSeeder::class);
    }
}
