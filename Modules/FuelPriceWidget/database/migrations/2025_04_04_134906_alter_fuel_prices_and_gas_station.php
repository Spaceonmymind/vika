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
        Schema::table('fuel_price_widget_fuel_prices', function (Blueprint $table) {
            $table->dropForeign(['fuel_type_id']);
            $table->foreign('fuel_type_id')->references('id')->on('fuel_price_widget_fuel_types')->cascadeOnDelete();
        });

        Schema::table('fuel_price_widget_gas_stations', function (Blueprint $table) {
            $table->dropForeign(['od_api_id']);
            $table->foreign('od_api_id')->references('id')->on('fuel_price_widget_od_datasets')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fuel_price_widget_fuel_prices', function (Blueprint $table) {
            $table->dropForeign(['fuel_type_id']);
            $table->foreign('fuel_type_id')->references('id')->on('fuel_price_widget_fuel_types')->restrictOnDelete();
        });

        Schema::table('fuel_price_widget_gas_stations', function (Blueprint $table) {
            $table->dropForeign(['od_api_id']);
            $table->foreign('od_api_id')->references('id')->on('fuel_price_widget_od_datasets')->restrictOnDelete();
        });
    }
};
