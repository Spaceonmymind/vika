<?php

namespace Modules\PetWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PetWidgetVetClinicEmailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('pet_widget_vet_clinic_emails')->delete();

        \DB::table('pet_widget_vet_clinic_emails')->insert(array (
            0 =>
            array (
                'id' => 1,
                'email' => 'aibolit-vet@yandex.ru',
                'clinic_id' => 2,
            ),
            1 =>
            array (
                'id' => 2,
                'email' => 'aibolithm@yandex.ru',
                'clinic_id' => 2,
            ),
            2 =>
            array (
                'id' => 3,
                'email' => 'aibolithm.ru',
                'clinic_id' => 2,
            ),
            3 =>
            array (
                'id' => 4,
                'email' => 'yaroslav_novikov_1995@mail.ru',
                'clinic_id' => 6,
            ),
            4 =>
            array (
                'id' => 5,
                'email' => 'zoodom86.ru',
                'clinic_id' => 6,
            ),
            5 =>
            array (
                'id' => 6,
                'email' => 'vet.ekspert86@mail.ru',
                'clinic_id' => 7,
            ),
            6 =>
            array (
                'id' => 7,
                'email' => 'zooelit@yandex.ru;',
                'clinic_id' => 8,
            ),
            7 =>
            array (
                'id' => 8,
                'email' => 'zooelit-klinika@yandex.ru',
                'clinic_id' => 8,
            ),
            8 =>
            array (
                'id' => 9,
                'email' => 'doktorzoo.surgut@mail.ru',
                'clinic_id' => 9,
            ),
            9 =>
            array (
                'id' => 10,
                'email' => 'zoodom86.ru',
                'clinic_id' => 16,
            ),
            10 =>
            array (
                'id' => 11,
                'email' => 'Zoovet86.ru',
                'clinic_id' => 16,
            ),
            11 =>
            array (
                'id' => 12,
                'email' => 'yaroslav_novikov_1995@mail.ru',
                'clinic_id' => 16,
            ),
            12 =>
            array (
                'id' => 13,
                'email' => 'E41vet-drug-nv@mail.ru',
                'clinic_id' => 19,
            ),
            13 =>
            array (
                'id' => 14,
                'email' => 'arkanova69@gmail.com',
                'clinic_id' => 20,
            ),
            14 =>
            array (
                'id' => 15,
                'email' => 'olga.ababiy@mail.ru',
                'clinic_id' => 21,
            ),
            15 =>
            array (
                'id' => 16,
                'email' => 'ira.khrulkova@mail.ru',
                'clinic_id' => 22,
            ),
            16 =>
            array (
                'id' => 17,
                'email' => 'vet-animalz@yandex.ru',
                'clinic_id' => 25,
            ),
            17 =>
            array (
                'id' => 18,
                'email' => 'pgshaislamov@yandex.ru',
                'clinic_id' => 26,
            ),
            18 =>
            array (
                'id' => 19,
                'email' => 'aibolit470202@gmail.com',
                'clinic_id' => 32,
            ),
            19 =>
            array (
                'id' => 20,
                'email' => '889825379937.2gis.biz',
                'clinic_id' => 33,
            ),
            20 =>
            array (
                'id' => 21,
                'email' => 'vetdoktor-nv@mail.ru',
                'clinic_id' => 34,
            ),
            21 =>
            array (
                'id' => 22,
                'email' => 'avis_81@mail.ru',
                'clinic_id' => 36,
            ),
            22 =>
            array (
                'id' => 23,
                'email' => 'vet-drug-nv@mail.ru',
                'clinic_id' => 37,
            ),
            23 =>
            array (
                'id' => 24,
                'email' => 'irbisvet-86@yandex.ru',
                'clinic_id' => 38,
            ),
            24 =>
            array (
                'id' => 25,
                'email' => 'vetcpnv@mail.ru',
                'clinic_id' => 39,
            ),
            25 =>
            array (
                'id' => 26,
                'email' => 'west71@mail.E4ru',
                'clinic_id' => 40,
            ),
            26 =>
            array (
                'id' => 27,
                'email' => 'vmirejivotnih@list.ru',
                'clinic_id' => 41,
            ),
            27 =>
            array (
                'id' => 28,
                'email' => 'vetlifenv.ru',
                'clinic_id' => 42,
            ),
            28 =>
            array (
                'id' => 29,
                'email' => 'palelulkoay@qp-izluchinsk.ru',
                'clinic_id' => 43,
            ),
            29 =>
            array (
                'id' => 30,
                'email' => 'rustam-gabazov2012@yandex.ru',
                'clinic_id' => 44,
            ),
        ));


    }
}
