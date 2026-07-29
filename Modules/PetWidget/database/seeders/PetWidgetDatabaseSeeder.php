<?php

namespace Modules\PetWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class PetWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(PetWidgetLocalitiesTableSeeder::class);
        $this->call(PetWidgetVetAreasTableSeeder::class);
        $this->call(PetWidgetVetClinicsTableSeeder::class);
        $this->call(PetWidgetVetClinicAddressesTableSeeder::class);
        $this->call(PetWidgetVetClinicEmailsTableSeeder::class);
        $this->call(PetWidgetVetClinicPhonesTableSeeder::class);
        $this->call(PetWidgetVetSheltersTableSeeder::class);
        $this->call(PetWidgetVetShelterAddressesTableSeeder::class);
        $this->call(PetWidgetVetShelterEmailsTableSeeder::class);
        $this->call(PetWidgetVetShelterPhonesTableSeeder::class);
    }
}
