<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('district_search_widget_hospitals', function (Blueprint $table) {
            $table->boolean('created_from_doctors_dataset')->after('phone')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('district_search_widget_hospitals', function (Blueprint $table) {
            $table->dropColumn('created_from_doctors_dataset');

        });
    }
};
