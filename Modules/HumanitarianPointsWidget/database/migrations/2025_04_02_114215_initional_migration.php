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
        Schema::create('humanitarian_points_widget_municipalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('humanitarian_points_widget_humanitarian_points', function (Blueprint $table) {
            $table->id();
            $table->string('name',500);
            $table->string('address',1000)->nullable();
            $table->string('contact_person_fio',1000)->nullable();
            $table->string('contact_person_email',1000)->nullable();
            $table->string('contact_person_phone',1000)->nullable();
            $table->unsignedBigInteger('municipality_id');

            $table->foreign('municipality_id' ,'h_p_w_h_p_m_id_fk')->references('id')->on('humanitarian_points_widget_municipalities')->cascadeOnDelete();
        });
        Schema::create('humanitarian_points_widget_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('token',500);
            $table->dateTime('valid_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('humanitarian_points_widget_humanitarian_points');
        Schema::dropIfExists('humanitarian_points_widget_municipalities');
        Schema::dropIfExists('humanitarian_points_widget_tokens');
    }
};
