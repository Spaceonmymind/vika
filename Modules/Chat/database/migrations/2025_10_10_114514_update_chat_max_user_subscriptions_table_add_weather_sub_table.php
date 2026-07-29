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
        Schema::create('chat_max_weather_school_class_ranges', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
        });

        Schema::create('chat_max_weather_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('school_class_range_id')->nullable()->comment('Диапазон классов школы');

            $table->foreign('school_class_range_id', 'fk_wscr')
                ->references('id')
                ->on('chat_max_weather_school_class_ranges')
                ->cascadeOnDelete();

            $table->foreign('city_id')
                ->references('id')
                ->on('actirovki_widget_cities')
                ->cascadeOnDelete();
        });

        Schema::table('chat_max_user_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('weather_subscription_id')->nullable();
            $table->dropColumn(['extra_params']);

            $table->foreign('weather_subscription_id')
                ->references('id')
                ->on('chat_max_weather_subscriptions')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_max_user_subscriptions', function (Blueprint $table) {
            $table->dropForeign(['weather_subscription_id']);
            $table->dropColumn('weather_subscription_id');
            $table->json('extra_params')->nullable();
        });

        Schema::dropIfExists('chat_max_weather_subscriptions');
        Schema::dropIfExists('chat_max_weather_school_class_ranges');
    }
};
