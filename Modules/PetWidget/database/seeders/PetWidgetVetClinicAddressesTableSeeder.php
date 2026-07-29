<?php

namespace Modules\PetWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PetWidgetVetClinicAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pet_widget_vet_clinic_addresses')->delete();

        \DB::table('pet_widget_vet_clinic_addresses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'address' => 'ул. Ледовая, 5, г. Ханты-Мансийск,',
                'clinic_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'address' => 'ул. Калинина, 69, г. Ханты-Мансийск',
                'clinic_id' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'address' => 'ул. Коминтерна, 22, г. Ханты-Мансийск',
                'clinic_id' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'address' => 'ул. Гагарина, 126, г. Ханты-Мансийск',
                'clinic_id' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'address' => 'ул. Мира, 66, г. Ханты-Мансийск',
                'clinic_id' => 5,
            ),
            5 =>
            array (
                'id' => 6,
                'address' => 'ул. Комсомольский проспект, 6а',
                'clinic_id' => 6,
            ),
            6 =>
            array (
                'id' => 7,
                'address' => 'Григория Кукуевицкого, 6/1',
                'clinic_id' => 6,
            ),
            7 =>
            array (
                'id' => 8,
                'address' => 'Привокзальная, 18/2',
                'clinic_id' => 6,
            ),
            8 =>
            array (
                'id' => 9,
                'address' => 'ул. проспект Ленина, 37/1, г. Сургут',
                'clinic_id' => 6,
            ),
            9 =>
            array (
                'id' => 10,
                'address' => 'Островского, 26/2 г. Сургут',
                'clinic_id' => 6,
            ),
            10 =>
            array (
                'id' => 11,
                'address' => 'ул. Профсоюзов, 30/1, г. Сургут',
                'clinic_id' => 7,
            ),
            11 =>
            array (
                'id' => 12,
                'address' => 'ул. Профсоюзов, 29/1',
                'clinic_id' => 8,
            ),
            12 =>
            array (
                'id' => 13,
                'address' => 'проспект Мира, 21 г.Сургут',
                'clinic_id' => 8,
            ),
            13 =>
            array (
                'id' => 14,
                'address' => 'ул. Иосифа Каролинского, 6, г. Сургут',
                'clinic_id' => 9,
            ),
            14 =>
            array (
                'id' => 15,
                'address' => 'ул. Университетская, 31, г. Сургут',
                'clinic_id' => 10,
            ),
            15 =>
            array (
                'id' => 16,
                'address' => 'ул. Маяковского, 7, г. Сургут',
                'clinic_id' => 11,
            ),
            16 =>
            array (
                'id' => 17,
                'address' => 'улица Энтузиастов, 1, пос. Нижнесортымский, Сургутский район',
                'clinic_id' => 12,
            ),
            17 =>
            array (
                'id' => 18,
                'address' => 'ул. Набережная ., 4, г. Лянтор, Сургутский район',
                'clinic_id' => 13,
            ),
            18 =>
            array (
                'id' => 19,
                'address' => '4-й микрорайон, 5, г. Лянтор, Сургутский район',
                'clinic_id' => 14,
            ),
            19 =>
            array (
                'id' => 20,
                'address' => 'ул.Кедровая, 19',
                'clinic_id' => 15,
            ),
            20 =>
            array (
                'id' => 21,
                'address' => 'микрорайон 16а, 85',
                'clinic_id' => 16,
            ),
            21 =>
            array (
                'id' => 22,
                'address' => 'ул.Парковая, 6/7',
                'clinic_id' => 17,
            ),
            22 =>
            array (
                'id' => 23,
                'address' => '16а микрорайон, 85',
                'clinic_id' => 18,
            ),
            23 =>
            array (
                'id' => 24,
                'address' => 'ул.Садовая, 17/1',
                'clinic_id' => 19,
            ),
            24 =>
            array (
                'id' => 25,
                'address' => 'ул. Кедровая, 50, г. Когалым',
                'clinic_id' => 20,
            ),
            25 =>
            array (
                'id' => 26,
                'address' => 'ул.Южная, 6, г. Когалым',
                'clinic_id' => 21,
            ),
            26 =>
            array (
                'id' => 27,
                'address' => 'улица Мира, 4, г. Покачи',
                'clinic_id' => 22,
            ),
            27 =>
            array (
                'id' => 28,
                'address' => 'Комсомольская улица, 24, г. Лангепас',
                'clinic_id' => 23,
            ),
            28 =>
            array (
                'id' => 29,
                'address' => 'Студенческая улица, 8, г. Пыть-Ях',
                'clinic_id' => 24,
            ),
            29 =>
            array (
                'id' => 30,
                'address' => 'ул. Московская, 15 5-й м-н, г. Нягань',
                'clinic_id' => 25,
            ),
            30 =>
            array (
                'id' => 31,
                'address' => 'ул. Интернациональная , 127А, г. Нягань',
                'clinic_id' => 26,
            ),
            31 =>
            array (
                'id' => 32,
                'address' => 'г. Югорск, ул. Мира, стр. 36/3',
                'clinic_id' => 27,
            ),
            32 =>
            array (
                'id' => 33,
                'address' => 'ул. Пожарского, 11',
                'clinic_id' => 28,
            ),
            33 =>
            array (
                'id' => 34,
                'address' => 'ул. Гагарина, 2/3, г. Советский',
                'clinic_id' => 29,
            ),
            34 =>
            array (
                'id' => 35,
                'address' => 'ул. Толстого, 21А, г. Урай',
                'clinic_id' => 30,
            ),
            35 =>
            array (
                'id' => 36,
                'address' => 'ул. Интернациональная, 11а;',
                'clinic_id' => 31,
            ),
            36 =>
            array (
                'id' => 37,
                'address' => 'ул. Ленина, 15/1, г. Нижневартовск, г. Нижневартовск',
                'clinic_id' => 32,
            ),
            37 =>
            array (
                'id' => 38,
                'address' => 'ул. Мира, 60А, Нижневартовск',
                'clinic_id' => 34,
            ),
            38 =>
            array (
                'id' => 39,
                'address' => 'ул. Салманова, 4, г. Нижневартовск',
                'clinic_id' => 35,
            ),
            39 =>
            array (
                'id' => 40,
                'address' => 'ул. Романтиков, 7, г. Нижневартовск',
                'clinic_id' => 36,
            ),
            40 =>
            array (
                'id' => 41,
                'address' => 'ул. Нефтяников, 8, г. Нижневартовск',
                'clinic_id' => 37,
            ),
            41 =>
            array (
                'id' => 42,
                'address' => 'ул. Омская, 66, г. Нижневартовск',
                'clinic_id' => 38,
            ),
            42 =>
            array (
                'id' => 43,
                'address' => 'ул. Чапаева, 17а, г. Нижневартовск',
                'clinic_id' => 39,
            ),
            43 =>
            array (
                'id' => 44,
                'address' => 'ул. Интернациональная, 8а, г. Нижневартовск',
                'clinic_id' => 40,
            ),
            44 =>
            array (
                'id' => 45,
                'address' => 'ул. Интернациональная, 27, г. Нижневартовск',
                'clinic_id' => 41,
            ),
            45 =>
            array (
                'id' => 46,
                'address' => 'ул. Набережная, 1, пгт Излучинск, Нижневартовский район',
                'clinic_id' => 42,
            ),
            46 =>
            array (
                'id' => 47,
                'address' => 'ул.Строителей, 12, пгт Излучинск, Нижневартовский район',
                'clinic_id' => 43,
            ),
            47 =>
            array (
                'id' => 48,
                'address' => 'мкр. 2-й, 2, г. Радужный',
                'clinic_id' => 44,
            ),
        ));


    }
}
