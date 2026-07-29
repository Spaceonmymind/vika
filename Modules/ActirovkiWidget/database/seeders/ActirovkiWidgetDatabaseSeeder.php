<?php

namespace Modules\ActirovkiWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class ActirovkiWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(ActirovkiWidgetCitiesTableSeeder::class);
        $this->call(ActirovkiWidgetWeatherRangesTableSeeder::class);
    }
}
