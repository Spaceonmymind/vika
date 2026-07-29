<?php

namespace Modules\RegionHeadHotlineWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class RegionHeadHotlineWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(RegionHeadHotlineWidgetBadWordsTableSeeder::class);
    }
}
