<?php

namespace Modules\InformationSystemsWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OdDatasetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('information_systems_widget_od_datasets')->delete();

        \DB::table('information_systems_widget_od_datasets')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'url' => 'https://itregistry.admhmao.ru/api/integration/passports/',
                    'data_type' => 'xml',
                    'class_handler' => 'Modules\\InformationSystemsWidget\\OpenDataHandlers\\SourceHandler',
                    'last_update' => NULL,
                    'description' => 'Справочник информационных систем',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                )
        ));

        Schema::enableForeignKeyConstraints();
    }
}
