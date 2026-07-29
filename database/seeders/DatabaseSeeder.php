<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\AbbreviationHelpWidget\Database\Seeders\AbbreviationHelpWidgetDatabaseSeeder;
use Modules\ActirovkiWidget\Database\Seeders\ActirovkiWidgetDatabaseSeeder;
use Modules\Admin\Database\Seeders\AdminDatabaseSeeder;
use Modules\AppointmentToDoctorWidget\Database\Seeders\AppointmentToDoctorWidgetDatabaseSeeder;
use Modules\BusinessSupportWidget\Database\Seeders\BusinessSupportWidgetDatabaseSeeder;
use Modules\Chat\Database\Seeders\ChatDatabaseSeeder;
use Modules\CultureUgraWidget\Database\Seeders\CultureUgraWidgetDatabaseSeeder;
use Modules\DistrictSearchWidget\Database\Seeders\DistrictSearchWidgetDatabaseSeeder;
use Modules\EmploymentUgraWidget\Database\Seeders\EmploymentUgraWidgetDatabaseSeeder;
use Modules\FuelPriceWidget\Database\Seeders\FuelPriceWidgetDatabaseSeeder;
use Modules\GosZakupkiWidget\Database\Seeders\GosZakupkiWidgetDatabaseSeeder;
use Modules\InformationSystemsWidget\Database\Seeders\InformationSystemsWidgetDatabaseSeeder;
use Modules\ITSupportWidget\Database\Seeders\ITSupportWidgetDatabaseSeeder;
use Modules\KMNSSupportWidget\Database\Seeders\KMNSSupportWidgetDatabaseSeeder;
use Modules\PetWidget\Database\Seeders\PetWidgetDatabaseSeeder;
use Modules\PfrHelpWidget\Database\Seeders\PfrHelpWidgetDatabaseSeeder;
use Modules\PhoneBookWidget\Database\Seeders\PhoneBookWidgetDatabaseSeeder;
use Modules\RegionHeadHotlineWidget\Database\Seeders\RegionHeadHotlineWidgetBadWordsTableSeeder;
use Modules\RegionHeadHotlineWidget\Database\Seeders\RegionHeadHotlineWidgetDatabaseSeeder;
use Modules\SocialSupportWidget\Database\Seeders\SocialSupportWidgetDatabaseSeeder;
use Modules\SportSectionsWidget\Database\Seeders\SportSectionsWidgetDatabaseSeeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // UserProfile::factory(10)->create();

//        UserProfile::factory()->create([
//            'name' => 'Test UserProfile',
//            'email' => 'test@example.com',
//        ]);
        $this->call(ChatDatabaseSeeder::class);
        $this->call(PhoneBookWidgetDatabaseSeeder::class);
        $this->call(FuelPriceWidgetDatabaseSeeder::class);
        $this->call(DistrictSearchWidgetDatabaseSeeder::class);
        $this->call(EmploymentUgraWidgetDatabaseSeeder::class);
        $this->call(PfrHelpWidgetDatabaseSeeder::class);
        $this->call(PetWidgetDatabaseSeeder::class);
        $this->call(SocialSupportWidgetDatabaseSeeder::class);
        $this->call(SportSectionsWidgetDatabaseSeeder::class);
        $this->call(BusinessSupportWidgetDatabaseSeeder::class);
        $this->call(ITSupportWidgetDatabaseSeeder::class);
        $this->call(KMNSSupportWidgetDatabaseSeeder::class);
        $this->call(CultureUgraWidgetDatabaseSeeder::class);
        $this->call(GosZakupkiWidgetDatabaseSeeder::class);
        $this->call(AbbreviationHelpWidgetDatabaseSeeder::class);
        $this->call(InformationSystemsWidgetDatabaseSeeder::class);
        $this->call(AdminDatabaseSeeder::class);
        $this->call(ActirovkiWidgetDatabaseSeeder::class);
        $this->call(AppointmentToDoctorWidgetDatabaseSeeder::class);
        $this->call(RegionHeadHotlineWidgetDatabaseSeeder::class);
    }
}
