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
        Schema::table('fuel_price_widget_fuel_prices',function (Blueprint $table){
            $table->dropColumn('created_at');
        });
        Schema::table('fuel_price_widget_gas_stations',function (Blueprint $table){
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

       Schema::table('fuel_price_widget_fuel_prices',function (Blueprint $table){
            $table->timestamp('created_at')->useCurrent();
        });

        Schema::table('fuel_price_widget_gas_stations',function (Blueprint $table){
            $table->dropColumn('created_at');
        });
    }
};
