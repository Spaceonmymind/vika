<?php

namespace Modules\ITSupportWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class ITSupportWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(ITSupportWidgetOdDatasetsTableSeeder::class);

    }
}
