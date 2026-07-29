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
        Schema::create('kmns_support_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
            $table->timestamp('last_update')->nullable();
        });
        Schema::create('kmns_support_widget_life_activity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('kmns_support_widget_measures', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('support_organisation')->nullable();
            $table->mediumText('subject')->nullable();
            $table->mediumText('terms')->nullable();
            $table->mediumText('apply_types')->nullable();
            $table->mediumText('get_result_types')->nullable();
            $table->mediumText('measure_result')->nullable();
            $table->mediumText('documents')->nullable();
            $table->string('link', 1000)->nullable();
            $table->unsignedBigInteger('activity_type_id');

            $table->foreign('activity_type_id')->references('id')->on('kmns_support_widget_life_activity_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
