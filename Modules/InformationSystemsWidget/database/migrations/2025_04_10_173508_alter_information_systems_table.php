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
        Schema::table('information_systems_widget_information_systems', function (Blueprint $table) {
            $table->text('unique_number')->nullable()->change();
            $table->text('full_name')->nullable()->change();
            $table->string('short_name')->nullable()->change();
            $table->text('targets')->nullable()->change();
            $table->string('state_info_sys')->nullable()->change();
            $table->string('url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
