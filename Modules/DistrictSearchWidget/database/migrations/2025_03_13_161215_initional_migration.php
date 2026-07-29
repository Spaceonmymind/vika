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
        Schema::create('district_search_widget_cities',function (Blueprint $table){
            $table->id();
            $table->string('name',500);
            $table->timestamps();

        });

        Schema::create('district_search_widget_hospitals',function (Blueprint $table){
            $table->id();
            $table->string('name',500);
            $table->string('address')->nullable();
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->timestamps();
        });
        Schema::create('district_search_widget_streets',function (Blueprint $table){
            $table->id();
            $table->string('name',500);
            $table->unsignedBigInteger('city_id');
            $table->timestamps();

            $table->foreign('city_id')->references('id')->on('district_search_widget_cities')->cascadeOnDelete();
        });
        Schema::create('district_search_widget_districts',function (Blueprint $table){
            $table->id();
            $table->string('number');
            $table->string('type');
            $table->string('address')->nullable();
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('city_id');

            $table->foreign('city_id')->references('id')->on('district_search_widget_cities')->cascadeOnDelete();
            $table->foreign('hospital_id')->references('id')->on('district_search_widget_hospitals')->cascadeOnDelete();
        });
        Schema::create('district_search_widget_doctors',function (Blueprint $table){
            $table->id();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('phone');
            $table->unsignedBigInteger('district_id');

            $table->foreign('district_id')->references('id')->on('district_search_widget_districts')->cascadeOnDelete();
        });

        Schema::create('district_search_widget_area_types',function (Blueprint $table){
            $table->id();
            $table->string('code');
            $table->string('name');
        });
        Schema::create('district_search_widget_areas',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('district_search_widget_area_type_id');
            $table->unsignedBigInteger('street_id');
            $table->unsignedBigInteger('city_id');
            $table->string('min_house_number',10);
            $table->string('max_house_number',10);

            $table->foreign('district_id')->references('id')->on('district_search_widget_districts')->cascadeOnDelete();
            $table->foreign('district_search_widget_area_type_id','dsw_area_area_type_fk')->references('id')->on('district_search_widget_area_types')->cascadeOnDelete();
            $table->foreign('street_id')->references('id')->on('district_search_widget_streets')->cascadeOnDelete();
            $table->foreign('city_id')->references('id')->on('district_search_widget_cities')->cascadeOnDelete();
        });
        Schema::create('district_search_widget_doctor_timetable_records',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('doctor_id');
            $table->integer('day_number');
            $table->boolean('odd_week');
            $table->boolean('is_break');

            $table->foreign('doctor_id','dsw_doctor_timetable_record_doctor_fk')->references('id')->on('district_search_widget_doctors')->cascadeOnDelete();
        });
        Schema::create('district_search_widget_od_dataset_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');

        });
        Schema::create('district_search_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
            $table->timestamp('last_update')->nullable();
            $table->unsignedBigInteger('dataset_type_id')->nullable();

            $table->foreign('dataset_type_id')->references('id')->on('district_search_widget_od_dataset_types')->restrictOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_search_widget_od_datasets');
        Schema::dropIfExists('district_search_widget_od_dataset_types');
        Schema::dropIfExists('district_search_widget_doctor_timetable_records');
        Schema::dropIfExists('district_search_widget_areas');
        Schema::dropIfExists('district_search_widget_area_types');
        Schema::dropIfExists('district_search_widget_doctors');
        Schema::dropIfExists('district_search_widget_districts');
        Schema::dropIfExists('district_search_widget_streets');
        Schema::dropIfExists('district_search_widget_hospitals');
        Schema::dropIfExists('district_search_widget_cities');
    }
};
