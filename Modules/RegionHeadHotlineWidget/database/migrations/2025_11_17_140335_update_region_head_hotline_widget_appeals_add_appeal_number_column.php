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
        Schema::table('region_head_hotline_widget_appeals', function (Blueprint $table) {
            $table->integer('appeal_number')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('region_head_hotline_widget_appeals', function (Blueprint $table) {
            $table->dropColumn('appeal_number');
        });
    }
};
