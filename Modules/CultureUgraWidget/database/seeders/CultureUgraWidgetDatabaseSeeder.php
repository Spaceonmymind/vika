<?php

namespace Modules\CultureUgraWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class CultureUgraWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $this->call(CultureUgraWidgetLocalitiesTableSeeder::class);
    }
}
