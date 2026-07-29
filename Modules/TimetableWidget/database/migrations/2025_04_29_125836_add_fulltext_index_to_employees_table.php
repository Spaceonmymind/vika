<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('timetable_widget_employees', function (Blueprint $table) {
            $table->fullText(['name'], 'ttw_employees_fulltext_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('timetable_widget_employees', function (Blueprint $table) {
            $table->dropIndex('ttw_employees_fulltext_index');
        });
    }
};
