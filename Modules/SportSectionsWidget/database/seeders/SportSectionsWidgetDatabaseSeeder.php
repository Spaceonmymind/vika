<?php

namespace Modules\SportSectionsWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class SportSectionsWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call(SportSectionsWidgetOdDatasetTypesTableSeeder::class);
         $this->call(SportSectionsWidgetOdDatasetMunicipalitiesTableSeeder::class);
         $this->call(SportSectionsWidgetOdDatasetsTableSeeder::class);
    }
}
