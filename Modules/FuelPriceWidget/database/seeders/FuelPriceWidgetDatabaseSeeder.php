<?php

namespace Modules\FuelPriceWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class FuelPriceWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(CitiesTableSeeder::class);
        $this->call(FuelTypesTableSeeder::class);
        $this->call(OdDatasetsTableSeeder::class);
    }
}
