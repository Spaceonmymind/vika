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
        Schema::create('information_systems_widget_operators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::table('information_systems_widget_information_systems', function (Blueprint $table) {
            $table->dropColumn('operator');

            $table->unsignedBigInteger('operator_id')->nullable();
            $table->foreign('operator_id', 'operator_fk')
                ->references('id')
                ->on('information_systems_widget_operators')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information_systems_widget_information_systems', function (Blueprint $table) {
            $table->dropForeign(['operator_id']);
            $table->dropColumn('operator_id');

            $table->string('operator');
        });

        Schema::dropIfExists('information_systems_widget_operators');
    }
};
