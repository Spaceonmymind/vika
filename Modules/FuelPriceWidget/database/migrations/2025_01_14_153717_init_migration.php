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
        Schema::create('fuel_price_widget_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
        });

        Schema::create('fuel_price_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->dateTime('last_update')->nullable();
            $table->dateTime('next_update')->nullable();
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
            $table->unsignedBigInteger('city_id')->nullable();

            $table->foreign('city_id')->references('id')->on('fuel_price_widget_cities')->restrictOnDelete();
        });

        Schema::create('fuel_price_widget_fuel_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('code', 255)->nullable();
        });

        Schema::create('fuel_price_widget_gas_stations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 10, 8)->unsigned()->nullable();
            $table->decimal('longitude', 10, 8)->unsigned()->nullable();
            $table->unsignedBigInteger('od_api_id');

            $table->foreign('od_api_id')->references('id')->on('fuel_price_widget_od_datasets')->restrictOnDelete();
        });

        Schema::create('fuel_price_widget_fuel_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gas_station_id');
            $table->unsignedBigInteger('fuel_type_id');
            $table->decimal('price', 6)->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('gas_station_id')->references('id')->on('fuel_price_widget_gas_stations')->restrictOnDelete();
            $table->foreign('fuel_type_id')->references('id')->on('fuel_price_widget_fuel_types')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fuel_price_widget_fuel_prices');
        Schema::dropIfExists('fuel_price_widget_gas_stations');
        Schema::dropIfExists('fuel_price_widget_fuel_types');
        Schema::dropIfExists('fuel_price_widget_od_datasets');
        Schema::dropIfExists('fuel_price_widget_cities');
    }
};
