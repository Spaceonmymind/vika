<?php

namespace Modules\PfrHelpWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PfrHelpWidgetQuestionCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //\DB::table('pfr_help_widget_question_categories')->delete();
        if (\DB::table('pfr_help_widget_question_categories')->count() > 0) {
            return;
        }

        \DB::table('pfr_help_widget_question_categories')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Как подать заявление?',
                'service_id' => 1,
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Мне назначили пособие',
                'service_id' => 1,
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Мне отказали в пособии',
                'service_id' => 1,
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Нет результата по заявлению',
                'service_id' => 1,
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Куда обращаться с вопросами?',
                'service_id' => 1,
            ),
        ));


    }
}
