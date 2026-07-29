<?php

namespace Modules\GosZakupkiWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class GosZakupkiWidgetQuestionCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('gos_zakupki_widget_question_categories')->delete();

        \DB::table('gos_zakupki_widget_question_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Общие вопросы',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Ведение планов-графиков. Планирование с 2020 года',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Ведение соглашений о совместных закупках с 2020 года',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Ведение закупок',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Ведение закупок малого объема',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Ведение проектов контрактов',
            ),
            6 =>
            array (
                'id' => 7,
            'name' => 'Ведение сведений о контракте (его изменении)',
            ),
            7 =>
            array (
                'id' => 8,
            'name' => 'Ведение сведений об исполнении (прекращении действия) контракта',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Нормирование в сфере закупок',
            ),
            9 =>
            array (
                'id' => 10,
                'name' => 'Описание пользовательского интерфейса',
            ),
            10 =>
            array (
                'id' => 11,
                'name' => 'Каталог товаров, работ, услуг',
            ),
            11 =>
            array (
                'id' => 12,
                'name' => 'Работа с листами согласований',
            ),
            12 =>
            array (
                'id' => 13,
                'name' => 'Ошибки при отправке в ЕИС',
            ),
            13 =>
            array (
                'id' => 14,
                'name' => 'Портал самообслуживания',
            ),
        ));


    }
}
