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
        Schema::create('information_systems_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->dateTime('last_update')->nullable();
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
        });

        Schema::create('information_systems_widget_information_systems', function (Blueprint $table) {
            $table->id();
            $table->text('unique_number');
            $table->text('full_name');
            $table->string('short_name');
            $table->text('targets');
            $table->string('owner');
            $table->text('subsystems');
            $table->string('state_info_sys');
            $table->string('operator');
            $table->string('url');
        });

        Schema::create('information_systems_widget_purposes', function (Blueprint $table) {
            $table->id();
            $table->text('name');
        });

        Schema::create('information_systems_widget_information_system_purpose', function (Blueprint $table) {
            $table->unsignedBigInteger('system_id');
            $table->unsignedBigInteger('purpose_id');

            $table->foreign('system_id', 'info_sys_fk')
                ->references('id')
                ->on('information_systems_widget_information_systems')
                ->cascadeOnDelete();

            $table->foreign('purpose_id', 'purpose_fk')
                ->references('id')
                ->on('information_systems_widget_purposes')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information_systems_widget_od_datasets');
        Schema::dropIfExists('information_systems_widget_information_system_purpose');
        Schema::dropIfExists('information_systems_widget_information_systems');
        Schema::dropIfExists('information_systems_widget_purposes');
    }
};
