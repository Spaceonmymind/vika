<?php

namespace Modules\PhoneBookWidget\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PhoneBookWidgetOdDatasetsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('phone_book_widget_od_datasets')->delete();

        \DB::table('phone_book_widget_od_datasets')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'url' => 'http://data.admhmao.ru/api/data/?id=2509744',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник Администрации города Когалыма',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            1 =>
                array(
                    'id' => 2,
                    'url' => 'https://admhmao.ru/phonebook/phone-s-post.xml',
                    'data_type' => 'xml',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\KhantyMansiyskAdministrationXmlSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник в xml с admhmao',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            2 =>
                array(
                    'id' => 3,
                    'url' => 'https://data.admhmao.ru/api/data/?id=1716816',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник Администрации г. Покачи',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            3 =>
                array(
                    'id' => 4,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2791235',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Белоярского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            4 =>
                array(
                    'id' => 5,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2773504',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Березовского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            5 =>
                array(
                    'id' => 6,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2788545',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Лангепас',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            6 =>
                array(
                    'id' => 7,
                    'url' => 'https://data.admhmao.ru/api/data/?id=1752715',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Мегион',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            7 =>
                array(
                    'id' => 8,
                    'url' => 'https://data.admhmao.ru/api/data/?id=1809258',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Пыть-Ях',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            8 =>
                array(
                    'id' => 9,
                    'url' => 'https://data.admhmao.ru/api/data/?id=3045724',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Радужный',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            9 =>
                array(
                    'id' => 10,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2035153',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Сургут',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            10 =>
                array(
                    'id' => 11,
                    'url' => 'https://data.admhmao.ru/api/data/?id=1810406',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Урай',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            11 =>
                array(
                    'id' => 12,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2779057',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации г. Югорск',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            12 =>
                array(
                    'id' => 13,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2792043',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Кондинского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            13 =>
                array(
                    'id' => 14,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2277177',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Нефтеюганского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            14 =>
                array(
                    'id' => 15,
                    'url' => 'https://data.n-vartovsk.ru/api/v1/8603032896-agphonedir/dataext?api_key=APP-VIKA_admhmao.ru&rows=1000',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\NizhnevartovskSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации города Нижневартовска',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            15 =>
                array(
                    'id' => 16,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2730994',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Октябрьского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            16 =>
                array(
                    'id' => 17,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2268144',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Советского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            17 =>
                array(
                    'id' => 18,
                    'url' => 'https://data.admhmao.ru/api/data/?id=3445517',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Сургутского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            18 =>
                array(
                    'id' => 19,
                    'url' => 'https://data.admhmao.ru/api/data/?id=2052389',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\AdmHmaoSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Ханты-Мансийского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            19 =>
                array(
                    'id' => 20,
                    'url' => 'https://data.admhmao.ru/api/data/?id=4278866',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\NizhnevartovskDistrictSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации Нижневартовского района',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            20 =>
                array(
                    'id' => 21,
                    'url' => 'http://admhmansy.ru/api/phonebook/?action=getAdministrationPhonebook',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\KhantyMansiyskAdministrationSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник администрации города Ханты-Мансийск',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
            21 =>
                array(
                    'id' => 22,
                    'url' => 'https://data.admhmao.ru/api/data/?id=1189910',
                    'data_type' => 'json',
                    'class_handler' => 'Modules\\PhoneBookWidget\\OpenDataHandlers\\NyaganCouncilSourceHandler',
                    'last_update' => NULL,
                    'description' => 'Телефонный справочник аппарата Думы города Нягани',
                    'need_update' => 0,
                    'is_active' => 1,
                    'current_hash' => NULL,
                ),
        ));

        Schema::enableForeignKeyConstraints();
    }
}
