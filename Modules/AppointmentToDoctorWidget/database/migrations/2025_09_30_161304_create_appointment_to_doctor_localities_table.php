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
        Schema::create('appointment_to_doctor_localities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('appointment_to_doctor_med_organisations', function (Blueprint $table) {
            $table->id();
            $table->string('oid_mo');
            $table->string('name');
            $table->unsignedBigInteger('locality_id');
            $table->foreign('locality_id')->references('id')->on('appointment_to_doctor_localities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_to_doctor_med_organisations');
        Schema::dropIfExists('appointment_to_doctor_localities');
    }
};
