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
        Schema::create('sport_sections_widget_od_dataset_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('sport_sections_widget_municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('sport_sections_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
            $table->dateTime('last_update')->nullable();
            $table->unsignedBigInteger('dataset_type_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->foreign('dataset_type_id')->references('id')->on('sport_sections_widget_od_dataset_types')->restrictOnDelete();
            $table->foreign('municipality_id')->references('id')->on('sport_sections_widget_municipalities')->restrictOnDelete();
        });

        Schema::create('sport_sections_widget_cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->foreign('municipality_id')->references('id')->on('sport_sections_widget_municipalities')->restrictOnDelete();
        });
        Schema::create('sport_sections_widget_organisations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 500)->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('inn')->nullable()->index();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->foreign('city_id')->references('id')->on('sport_sections_widget_cities')->restrictOnDelete();
            $table->foreign('municipality_id')->references('id')->on('sport_sections_widget_municipalities')->restrictOnDelete();
        });

        Schema::create('sport_sections_widget_trainers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->foreign('municipality_id')->references('id')->on('sport_sections_widget_municipalities')->restrictOnDelete();
        });

        Schema::create('sport_sections_widget_sports', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->index();
        });

        Schema::create('sport_sections_widget_sport_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organisation_id')->nullable();
            $table->unsignedBigInteger('sport_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->unsignedBigInteger('trainer_id')->nullable();
            $table->unsignedInteger('age_min')->nullable();
            $table->unsignedInteger('age_max')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->foreign('organisation_id')->references('id')->on('sport_sections_widget_organisations')->cascadeOnDelete();
            $table->foreign('sport_id')->references('id')->on('sport_sections_widget_sports')->restrictOnDelete();
            $table->foreign('city_id')->references('id')->on('sport_sections_widget_cities')->restrictOnDelete();
            $table->foreign('trainer_id')->references('id')->on('sport_sections_widget_trainers')->cascadeOnDelete();
            $table->foreign('municipality_id')->references('id')->on('sport_sections_widget_municipalities')->restrictOnDelete();
        });

        Schema::create('sport_sections_widget_sections_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('section_id');
            $table->string('monday')->nullable();
            $table->string('tuesday')->nullable();
            $table->string('wednesday')->nullable();
            $table->string('thursday')->nullable();
            $table->string('friday')->nullable();
            $table->string('saturday')->nullable();
            $table->string('sunday')->nullable();

            $table->foreign('section_id')->references('id')->on('sport_sections_widget_sport_sections')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_sections_widget_od_datasets');

        Schema::dropIfExists('sport_sections_widget_sections_schedules');
        Schema::dropIfExists('sport_sections_widget_sport_sections');
        Schema::dropIfExists('sport_sections_widget_trainers');
        Schema::dropIfExists('sport_sections_widget_sports');

        Schema::dropIfExists('sport_sections_widget_organisations');

        Schema::dropIfExists('sport_sections_widget_od_dataset_types');
        Schema::dropIfExists('sport_sections_widget_cities');
        Schema::dropIfExists('sport_sections_widget_municipalities');
    }
};
