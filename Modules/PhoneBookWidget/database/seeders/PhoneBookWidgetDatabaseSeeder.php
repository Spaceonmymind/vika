<?php

namespace Modules\PhoneBookWidget\Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PhoneBookWidgetDatabaseSeeder extends Seeder
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
        $this->call(PhoneBookWidgetOdDatasetsTableSeeder::class);
    }
}
