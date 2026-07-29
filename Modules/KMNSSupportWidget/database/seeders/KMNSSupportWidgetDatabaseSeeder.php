<?php

namespace Modules\KMNSSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class KMNSSupportWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(KmnsSupportWidgetOdDatasetsTableSeeder::class);

    }
}
