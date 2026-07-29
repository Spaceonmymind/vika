<?php

namespace Modules\EmploymentUgraWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class EmploymentUgraWidgetCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        //\DB::table('employment_ugra_widget_categories')->delete();
        if (\DB::table('employment_ugra_widget_categories')->count() > 0) {
            return;
        }

        \DB::table('employment_ugra_widget_categories')->insert([
            0 =>
                [
                    'id' => 1,
                    'name' => 'Содействие трудоустройству',
                ],
            1 =>
                [
                    'id' => 2,
                    'name' => 'Трудовая миграция',
                ],
            2 =>
                [
                    'id' => 3,
                    'name' => 'Предоставление гарантий и компенсаций',
                ],
            3 =>
                [
                    'id' => 4,
                    'name' => 'Квотирование рабочих мест для инвалидов',
                ],
            4 =>
                [
                    'id' => 5,
                    'name' => 'Профессиональное обучение',
                ],
            5 =>
                [
                    'id' => 6,
                    'name' => 'Охрана труда',
                ],
        ]);

    }
}
