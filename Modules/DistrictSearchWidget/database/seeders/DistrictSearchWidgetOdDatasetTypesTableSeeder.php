<?php

namespace Modules\DistrictSearchWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictSearchWidgetOdDatasetTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        //\DB::table('district_search_widget_od_dataset_types')->delete();

       $data=array (
            0 =>
            array (
                'id' => 1,
                'code' => 'hospitals',
                'name' => 'Медицинские организации',
            ),
            1 =>
            array (
                'id' => 2,
                'code' => 'doctors',
                'name' => 'Информация об участках и их врачах',
            ),
            2 =>
            array (
                'id' => 3,
                'code' => 'district_areas',
                'name' => 'Расположение участков',
            ),
        );
        foreach ($data as $row){
            if(\DB::table('district_search_widget_od_dataset_types')->where('id',$row['id'])->doesntExist()){

                \DB::table('district_search_widget_od_dataset_types')->insert($row);
            }
        }

    }
}
