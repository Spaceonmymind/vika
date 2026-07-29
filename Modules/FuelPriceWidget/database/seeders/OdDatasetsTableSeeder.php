<?php

namespace Modules\FuelPriceWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class OdDatasetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        \DB::table('fuel_price_widget_od_datasets')->delete();

        \DB::table('fuel_price_widget_od_datasets')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2791688',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в Кондинском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 1,
                ),
            1 =>
                array(
                    'id' => 2,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2788828',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ города Лангепас',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 2,
                ),
            2 =>
                array(
                    'id' => 3,
                    'url' => 'http://data.admhmao.ru/api/data/?id=2177254',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ. Нефтеюганский район',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 3,
                ),
            3 =>
                array(
                    'id' => 4,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2979081',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в городе Пыть-Яхе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 4,
                ),
            4 =>
                array(
                    'id' => 5,
                    'url' => 'http://data.admhmao.ru/api/data/?id=2017462',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ г. Сургут',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 5,
                ),
            5 =>
                array(
                    'id' => 6,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2016563',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в Ханты-Мансийском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 6,
                ),
            6 =>
                array(
                    'id' => 7,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2010607',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в Когалыме',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 7,
                ),
            7 =>
                array(
                    'id' => 8,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2010446',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в Октябрьском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 8,
                ),
            8 =>
                array(
                    'id' => 9,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2052180',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Покачи',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 9,
                ),
            9 =>
                array(
                    'id' => 10,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2790441',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в Белоярском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 10,
                ),
            10 =>
                array(
                    'id' => 11,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2788918',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в Березовском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 11,
                ),
            11 =>
                array(
                    'id' => 12,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2011899',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Мегион',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 12,
                ),
            12 =>
                array(
                    'id' => 13,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2696383',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Урай',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 13,
                ),
            13 =>
                array(
                    'id' => 14,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2428777',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Югорск',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 14,
                ),
            14 =>
                array(
                    'id' => 15,
                    'url' => 'https://data.admhmao.ru/api/data/?id=3476547',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в Сургутском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 15,
                ),
            15 =>
                array(
                    'id' => 16,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2864386',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в Советском районе (обновляется раз в неделю)',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 16,
                ),
            16 =>
                array(
                    'id' => 17,
                    'url' => 'https://data.n-vartovsk.ru/api/v1/8603032896-roadgasstationprice/data?api_key=APP-VIKA_admhmao.ru&rows=500',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\NizhnevartovskSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на ГСМ в г. Нижневартовске',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 17,
                ),
            17 =>
                array(
                    'id' => 18,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2979058',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в Нижневартовском районе',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 18,
                ),
            18 =>
                array(
                    'id' => 19,
                    'url' => 'https://data.admhmao.ru/api/data/?id=3090047',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Стоимость топлива в г. Ханты-Мансийск',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 19,
                ),
            19 =>
                array(
                    'id' => 20,
                    'url' => 'https://data.admhmao.ru/api/data/?id=3045689',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Радужный',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 20,
                ),
            20 =>
                array(
                    'id' => 21,
                    'url' => 'https://data.admhmao.ru/api/data/?id=5593960',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Нягань',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 21,
                ),
            21 =>
                array(
                    'id' => 22,
                    'url' => 'https://data.admhmao.ru/api/data/?id=3330469',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\FuelPriceWidget\\OpenDataHandlers\\NefteyuganskSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Цены на топливо в г. Нефтеюганск',
                    'need_update' => 1,
                    'is_active' => 1,
                    'current_hash' => NULL,
                    'city_id' => 22,
                ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
