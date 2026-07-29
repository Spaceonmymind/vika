<?php

namespace Modules\AppointmentToDoctorWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class AppointmentToDoctorWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $this->call(AppointmentToDoctorLocalitiesTableSeeder::class);
        $this->call(AppointmentToDoctorMedOrganisationsTableSeeder::class);
    }
}
