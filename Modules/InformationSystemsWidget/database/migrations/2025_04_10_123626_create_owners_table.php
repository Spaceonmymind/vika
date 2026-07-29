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
        Schema::create('information_systems_widget_owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::table('information_systems_widget_information_systems', function (Blueprint $table) {
            $table->dropColumn('owner');
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->foreign('owner_id')->references('id')->on('information_systems_widget_owners')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information_systems_widget_information_systems', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropColumn('owner_id');

            $table->string('owner');
        });

        Schema::dropIfExists('information_systems_widget_owners');
    }
};
