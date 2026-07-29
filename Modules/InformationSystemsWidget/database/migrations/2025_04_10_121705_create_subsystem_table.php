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
        Schema::create('information_systems_widget_subsystems', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('site')->nullable();
            $table->string('helpdesk')->nullable();
        });

        Schema::create('information_systems_widget_information_system_subsystem', function (Blueprint $table) {
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('subsystem_id');

            $table->foreign('system_id', 'info_system_fk')
                ->references('id')
                ->on('information_systems_widget_information_systems')
                ->cascadeOnDelete();

            $table->foreign('subsystem_id', 'subsystem_fk')
                ->references('id')
                ->on('information_systems_widget_subsystems')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_systems_widget_information_system_subsystem');
        Schema::dropIfExists('information_systems_widget_subsystems');
    }
};
