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
        Schema::table('district_search_widget_doctor_timetable_records', function (Blueprint $table) {

            $table->string('time',40)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('district_search_widget_doctor_timetable_records', function (Blueprint $table) {

            $table->dropColumn('time');

        });

    }
};
