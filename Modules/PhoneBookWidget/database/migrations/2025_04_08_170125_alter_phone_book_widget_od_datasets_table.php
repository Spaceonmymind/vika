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
        Schema::table('phone_book_widget_od_datasets', function (Blueprint $table) {
            $table->dropColumn('next_update');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phone_book_widget_od_datasets', function (Blueprint $table) {
            $table->dateTime('next_update')->nullable();
        });
    }
};
