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
        Schema::create('business_support_widget_municipalities',function (Blueprint $table){
            $table->id();
            $table->string('name');
        });
        Schema::create('business_support_widget_support_organisations',function (Blueprint $table){
            $table->id();
            $table->string('name');
        });
        Schema::create('business_support_widget_situations',function (Blueprint $table){
            $table->id();
            $table->string('name',1000);
        });
        Schema::create('business_support_widget_subjects',function (Blueprint $table){
            $table->id();
            $table->string('name',1000);
        });
        Schema::create('business_support_widget_registration_places',function (Blueprint $table){
            $table->id();
            $table->string('name',1000);
        });
        Schema::create('business_support_widget_support_types',function (Blueprint $table){
            $table->id();
            $table->string('name');
        });
        Schema::create('business_support_widget_measures',function (Blueprint $table){
            $table->id();
            $table->mediumText('name');
            $table->mediumText('description')->nullable();
            $table->mediumText('conditions')->nullable();
            $table->mediumText('activities')->nullable();
            $table->mediumText('financial_support')->nullable();
            $table->mediumText('terms')->nullable();
            $table->mediumText('law')->nullable();
            $table->mediumText('revenue_year')->nullable();
            $table->mediumText('company_age')->nullable();
            $table->mediumText('documents')->nullable();
            $table->mediumText('date_receipt_documents')->nullable();
            $table->mediumText('employees')->nullable();
            $table->mediumText('contacts')->nullable();
            $table->unsignedBigInteger('situation_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('registration_place_id')->nullable();
            $table->unsignedBigInteger('support_organisation_id')->nullable();
            $table->unsignedBigInteger('support_type_id')->nullable();
            $table->unsignedBigInteger('municipality_id');

            $table->foreign('situation_id')->references('id')->on('business_support_widget_situations')->cascadeOnDelete();
            $table->foreign('subject_id')->references('id')->on('business_support_widget_subjects')->cascadeOnDelete();
            $table->foreign('registration_place_id')->references('id')->on('business_support_widget_registration_places')->cascadeOnDelete();
            $table->foreign('support_organisation_id')->references('id')->on('business_support_widget_support_organisations')->cascadeOnDelete();
            $table->foreign('support_type_id')->references('id')->on('business_support_widget_support_types')->cascadeOnDelete();
            $table->foreign('municipality_id')->references('id')->on('business_support_widget_municipalities')->cascadeOnDelete();

        });
        Schema::create('business_support_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
            $table->timestamp('last_update')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->foreign('municipality_id')->references('id')->on('business_support_widget_municipalities')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_support_widget_od_datasets');
        Schema::dropIfExists('business_support_widget_measures');
        Schema::dropIfExists('business_support_widget_support_types');
        Schema::dropIfExists('business_support_widget_registration_places');
        Schema::dropIfExists('business_support_widget_subjects');
        Schema::dropIfExists('business_support_widget_situations');
        Schema::dropIfExists('business_support_widget_support_organisations');
        Schema::dropIfExists('business_support_widget_municipalities');
    }
};
