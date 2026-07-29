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
        Schema::table('chat_max_weather_subscriptions', function (Blueprint $table) {
            $table->tinyInteger('school_shift')->nullable()->comment('Смена школы (1 - первая, 2 - вторая)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_max_weather_subscriptions', function (Blueprint $table) {
            $table->dropColumn(['school_shift']);
        });
    }
};
