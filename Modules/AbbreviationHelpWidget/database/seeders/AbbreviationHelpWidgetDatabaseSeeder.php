<?php

namespace Modules\AbbreviationHelpWidget\Database\Seeders;

use Illuminate\Database\Seeder;

class AbbreviationHelpWidgetDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call(AbbreviationHelpWidgetAbbreviationsTableSeeder::class);

    }
}
