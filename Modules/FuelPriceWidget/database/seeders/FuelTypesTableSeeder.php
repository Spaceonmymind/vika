<?php

namespace Modules\FuelPriceWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FuelTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('fuel_price_widget_fuel_types')->delete();

        \DB::table('fuel_price_widget_fuel_types')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'name' => 'АИ-92',
                    'code' => 'ai_92',
                ),
            1 =>
                array(
                    'id' => 2,
                    'name' => 'АИ-95',
                    'code' => 'ai_95',
                ),
            2 =>
                array(
                    'id' => 3,
                    'name' => 'АИ-98',
                    'code' => 'ai_98',
                ),
            3 =>
                array(
                    'id' => 4,
                    'name' => 'АИ-100',
                    'code' => 'ai_100',
                ),
            4 =>
                array(
                    'id' => 5,
                    'name' => 'Бутан',
                    'code' => 'butane',
                ),
            5 =>
                array(
                    'id' => 6,
                    'name' => 'Пропан',
                    'code' => 'propane',
                ),
            6 =>
                array(
                    'id' => 7,
                    'name' => 'Метан',
                    'code' => 'methane',
                ),
            7 =>
                array(
                    'id' => 8,
                    'name' => 'Дизель',
                    'code' => 'diesel',
                ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
