<?php

namespace Modules\PfrHelpWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PfrHelpWidgetServicesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        if (\DB::table('pfr_help_widget_services')->count() > 0) {
            return;
        }

        //\DB::table('pfr_help_widget_services')->delete();

        \DB::table('pfr_help_widget_services')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Ежемесячное пособие на ребенка в возрасте от 8 до 17 лет',
            ),
        ));


    }
}
