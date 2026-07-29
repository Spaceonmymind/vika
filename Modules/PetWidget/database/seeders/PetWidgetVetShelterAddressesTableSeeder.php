<?php

namespace Modules\PetWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PetWidgetVetShelterAddressesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pet_widget_vet_shelter_addresses')->delete();

        \DB::table('pet_widget_vet_shelter_addresses')->insert(array (
            0 =>
            array (
                'id' => 1,
                'address' => 'г. Белоярский,проезд Ратькова, 7/9',
                'shelter_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'address' => 'г. Белоярский,проезд Ратькова, 7/9',
                'shelter_id' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'address' => 'г. Когалым, ул.Южная, 6',
                'shelter_id' => 3,
            ),
            3 =>
            array (
                'id' => 4,
                'address' => 'пгт. Междуреченский, ул. Промышленная, 7',
                'shelter_id' => 4,
            ),
            4 =>
            array (
                'id' => 5,
                'address' => 'пгт. Междуреченский, ул.Нефтепроводная, 2',
                'shelter_id' => 5,
            ),
            5 =>
            array (
                'id' => 6,
                'address' => 'г. Покачи, проезд Индустриальный 5/6, проходная №1',
                'shelter_id' => 6,
            ),
            6 =>
            array (
                'id' => 7,
                'address' => 'г. Покачи, проезд Индустриальный 5/6, проходная №1',
                'shelter_id' => 7,
            ),
            7 =>
            array (
                'id' => 8,
                'address' => 'г. Мегион, ул. Береговая, д. 14',
                'shelter_id' => 8,
            ),
            8 =>
            array (
                'id' => 9,
                'address' => 'г. Пыть-Ях,промзона западная, ул. Мамонтовская, 12/1',
                'shelter_id' => 9,
            ),
            9 =>
            array (
                'id' => 10,
                'address' => 'г. Пыть-Ях,промзона западная, ул. Мамонтовская, 12/1',
                'shelter_id' => 10,
            ),
            10 =>
            array (
                'id' => 11,
                'address' => 'г. Пыть-Ях,промзона западная, ул. Мамонтовская, 12/1',
                'shelter_id' => 11,
            ),
            11 =>
            array (
                'id' => 12,
                'address' => 'г. Нижневартовск, ул. 2п-2, д. 68, стр. 5',
                'shelter_id' => 12,
            ),
            12 =>
            array (
                'id' => 13,
                'address' => 'г. Нижневартовск, ул. 2п-2, д. 68, стр. 5',
                'shelter_id' => 13,
            ),
            13 =>
            array (
                'id' => 14,
                'address' => 'г. Нягань, ул. Сибирская, д. 32, корп. 2, пом. 1',
                'shelter_id' => 14,
            ),
            14 =>
            array (
                'id' => 15,
                'address' => 'г. Нягань, ул. Сибирская, д. 32, корп. 2, пом. 1',
                'shelter_id' => 15,
            ),
            15 =>
            array (
                'id' => 16,
                'address' => 'г. Радужный, мкр. 6, д. 18, п. 18/5',
                'shelter_id' => 16,
            ),
            16 =>
            array (
                'id' => 17,
                'address' => 'Советский район, г. Советский, Восточная промышленная зона',
                'shelter_id' => 17,
            ),
            17 =>
            array (
                'id' => 18,
                'address' => 'г. Сургут, Югорская, д. 34',
                'shelter_id' => 18,
            ),
            18 =>
            array (
                'id' => 19,
                'address' => 'Сургутский район, г. Лянтор, ул. Буровиков д. 1',
                'shelter_id' => 19,
            ),
            19 =>
            array (
                'id' => 20,
                'address' => 'Сургутский район, гп. Белый Яр, ул. Таежная, 26а',
                'shelter_id' => 20,
            ),
            20 =>
            array (
                'id' => 21,
                'address' => 'г. Сургут, Югорская, д. 34',
                'shelter_id' => 21,
            ),
            21 =>
            array (
                'id' => 22,
                'address' => 'Сургутский район, г. Лянтор, ул. Буровиков д. 1',
                'shelter_id' => 22,
            ),
            22 =>
            array (
                'id' => 23,
                'address' => 'Сургутский район, гп. Белый Яр, ул. Таежная, 26а',
                'shelter_id' => 23,
            ),
            23 =>
            array (
                'id' => 24,
                'address' => 'г. Урай, микрорайон 1Д, дом 87',
                'shelter_id' => 24,
            ),
            24 =>
            array (
                'id' => 25,
                'address' => 'г. Урай, пер. Животноводческий, д. 6',
                'shelter_id' => 25,
            ),
            25 =>
            array (
                'id' => 26,
                'address' => 'г. Ханты-Мансийск, ул. Калинина, 117а',
                'shelter_id' => 26,
            ),
            26 =>
            array (
                'id' => 27,
                'address' => 'г. Ханты-Мансийск, ул. Калинина, 117а',
                'shelter_id' => 27,
            ),
            27 =>
            array (
                'id' => 28,
                'address' => 'г. Югорск, ул. Геологов, 15',
                'shelter_id' => 28,
            ),
        ));


    }
}
