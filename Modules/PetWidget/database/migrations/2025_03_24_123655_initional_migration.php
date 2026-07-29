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
        Schema::create('pet_widget_localities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('pet_widget_vet_clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('locality_id');

            $table->foreign('locality_id')->references('id')->on('pet_widget_localities')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_clinic_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->unsignedBigInteger('clinic_id');

            $table->foreign('clinic_id')->references('id')->on('pet_widget_vet_clinics')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_clinic_phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->unsignedBigInteger('clinic_id');

            $table->foreign('clinic_id')->references('id')->on('pet_widget_vet_clinics')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_clinic_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('clinic_id');

            $table->foreign('clinic_id')->references('id')->on('pet_widget_vet_clinics')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_shelters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('locality_id');

            $table->foreign('locality_id')->references('id')->on('pet_widget_localities')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_shelter_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->unsignedBigInteger('shelter_id');

            $table->foreign('shelter_id')->references('id')->on('pet_widget_vet_shelters')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_shelter_phones', function (Blueprint $table) {
            $table->id();
            $table->string('phone');
            $table->unsignedBigInteger('shelter_id');

            $table->foreign('shelter_id')->references('id')->on('pet_widget_vet_shelters')->cascadeOnDelete();
        });

        Schema::create('pet_widget_vet_shelter_emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('shelter_id');

            $table->foreign('shelter_id')->references('id')->on('pet_widget_vet_shelters')->cascadeOnDelete();
        });


        Schema::create('pet_widget_vet_areas', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->unsignedBigInteger('locality_id');

            $table->foreign('locality_id')->references('id')->on('pet_widget_localities')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pet_widget_vet_areas');
        Schema::dropIfExists('pet_widget_vet_shelter_emails');
        Schema::dropIfExists('pet_widget_vet_shelter_phones');
        Schema::dropIfExists('pet_widget_vet_shelter_addresses');
        Schema::dropIfExists('pet_widget_vet_shelters');
        Schema::dropIfExists('pet_widget_vet_clinic_emails');
        Schema::dropIfExists('pet_widget_vet_clinic_phones');
        Schema::dropIfExists('pet_widget_vet_clinic_addresses');
        Schema::dropIfExists('pet_widget_vet_clinics');
        Schema::dropIfExists('pet_widget_localities');
    }
};
