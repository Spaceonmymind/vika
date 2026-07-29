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
        Schema::create('actirovki_widget_cities', static function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('fias_id', 36)->index();
        });
        Schema::create('actirovki_widget_weather_ranges', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('actirovki_widget_cities')->cascadeOnDelete();
            $table->decimal('temperature', 3, 1);
            $table->decimal('wind', 3, 1);
            $table->unsignedTinyInteger('school_class')->comment('Максимальный класс, по который объявляется актировка при данных значениях скорости ветра и температуры');

            $table->index(['city_id', 'temperature', 'wind'], 'city_id_temperature_wind_index');
        });
        Schema::create('actirovki_widget_weathers', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('actirovki_widget_cities')->cascadeOnDelete();
            $table->decimal('temperature', 3, 1);
            $table->decimal('wind', 3, 1);
            $table->dateTime('created_at');
        });
        Schema::create('actirovki_widget_rows', static function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('actirovki_widget_cities')->cascadeOnDelete();
            $table->foreignId('weather_id')->constrained('actirovki_widget_weathers')->cascadeOnDelete();
            $table->foreignId('weather_range_id')->constrained('actirovki_widget_weather_ranges')->cascadeOnDelete();
            $table->foreignId('cancel_user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('school_shift')->comment('Номер школьной смены: 1 или 2');
            $table->dateTime('created_at')->index();
            $table->dateTime('cancel_at')->nullable();
            $table->dateTime('send_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actirovki_widget_rows');
        Schema::dropIfExists('actirovki_widget_weathers');
        Schema::dropIfExists('actirovki_widget_weather_ranges');
        Schema::dropIfExists('actirovki_widget_cities');
    }
};
