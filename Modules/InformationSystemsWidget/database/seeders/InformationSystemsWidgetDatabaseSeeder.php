<?php

namespace Modules\InformationSystemsWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class InformationSystemsWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(OdDatasetsTableSeeder::class);
    }
}
