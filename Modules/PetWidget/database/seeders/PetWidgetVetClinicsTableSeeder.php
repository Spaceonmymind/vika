<?php

namespace Modules\PetWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PetWidgetVetClinicsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pet_widget_vet_clinics')->delete();

        \DB::table('pet_widget_vet_clinics')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Прайд',
                'locality_id' => 21,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Айболит',
                'locality_id' => 21,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Animals',
                'locality_id' => 21,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Ветеринарная клиника',
                'locality_id' => 21,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Зооветцентр №1',
                'locality_id' => 21,
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Зооветцентр',
                'locality_id' => 17,
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'ВетЭксперт',
                'locality_id' => 17,
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'ЗооЭлит',
                'locality_id' => 17,
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Доктор зоо',
                'locality_id' => 17,
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Милый друг',
                'locality_id' => 17,
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'В мире животных',
                'locality_id' => 17,
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Мявчик и Гавчик',
                'locality_id' => 18,
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'доктор Алявдин',
                'locality_id' => 18,
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Зооветцентр',
                'locality_id' => 18,
            ),
            14 =>
            array (
                'id' => 15,
                'name' => 'Прайд-Н',
                'locality_id' => 8,
            ),
            15 =>
            array (
                'id' => 16,
                'name' => 'Зооветцентр',
                'locality_id' => 8,
            ),
            16 =>
            array (
                'id' => 17,
                'name' => 'Айболит',
                'locality_id' => 8,
            ),
            17 =>
            array (
                'id' => 18,
                'name' => 'Кот и пес',
                'locality_id' => 8,
            ),
            18 =>
            array (
                'id' => 19,
                'name' => 'Мега друг',
                'locality_id' => 7,
            ),
            19 =>
            array (
                'id' => 20,
                'name' => 'ветеринарный кабинет',
                'locality_id' => 3,
            ),
            20 =>
            array (
                'id' => 21,
                'name' => 'Айболит',
                'locality_id' => 3,
            ),
            21 =>
            array (
                'id' => 22,
                'name' => 'Добрый доктор',
                'locality_id' => 6,
            ),
            22 =>
            array (
                'id' => 23,
                'name' => 'Vet for pets',
                'locality_id' => 5,
            ),
            23 =>
            array (
                'id' => 24,
                'name' => 'Ветеринарная клиника',
                'locality_id' => 9,
            ),
            24 =>
            array (
                'id' => 25,
                'name' => 'Анималз',
                'locality_id' => 13,
            ),
            25 =>
            array (
                'id' => 26,
                'name' => 'Айболит',
                'locality_id' => 13,
            ),
            26 =>
            array (
                'id' => 27,
                'name' => 'ЗАБОТА',
                'locality_id' => 22,
            ),
            27 =>
            array (
                'id' => 28,
                'name' => 'Ветеринарный кабинет',
                'locality_id' => 22,
            ),
            28 =>
            array (
                'id' => 29,
                'name' => 'Вет+',
                'locality_id' => 16,
            ),
            29 =>
            array (
                'id' => 30,
                'name' => 'ДокторВет',
                'locality_id' => 19,
            ),
            30 =>
            array (
                'id' => 31,
                'name' => 'Ёжкин Кот',
                'locality_id' => 11,
            ),
            31 =>
            array (
                'id' => 32,
                'name' => 'Айболит',
                'locality_id' => 11,
            ),
            32 =>
            array (
                'id' => 33,
                'name' => 'Пес и кот',
                'locality_id' => 11,
            ),
            33 =>
            array (
                'id' => 34,
                'name' => 'Vet-доктор',
                'locality_id' => 11,
            ),
            34 =>
            array (
                'id' => 35,
                'name' => 'ЭЛИТВЕТ',
                'locality_id' => 11,
            ),
            35 =>
            array (
                'id' => 36,
                'name' => 'A/Isvet',
                'locality_id' => 11,
            ),
            36 =>
            array (
                'id' => 37,
                'name' => 'Друг',
                'locality_id' => 11,
            ),
            37 =>
            array (
                'id' => 38,
                'name' => 'Ирбис',
                'locality_id' => 11,
            ),
            38 =>
            array (
                'id' => 39,
                'name' => 'Ветеринарный кабинет',
                'locality_id' => 11,
            ),
            39 =>
            array (
                'id' => 40,
                'name' => 'Фламинго',
                'locality_id' => 11,
            ),
            40 =>
            array (
                'id' => 41,
                'name' => 'В мире животных',
                'locality_id' => 11,
            ),
            41 =>
            array (
                'id' => 42,
                'name' => 'Пегас',
                'locality_id' => 12,
            ),
            42 =>
            array (
                'id' => 43,
                'name' => 'Пушистый хвост',
                'locality_id' => 12,
            ),
            43 =>
            array (
                'id' => 44,
                'name' => 'Друг',
                'locality_id' => 15,
            ),
        ));


    }
}
