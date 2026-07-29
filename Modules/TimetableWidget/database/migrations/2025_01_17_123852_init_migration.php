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
        Schema::create('timetable_widget_organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('timesheet_name')->nullable();
            $table->uuid('global_id')->unique();
            $table->timestamps();
        });

        Schema::create('timetable_widget_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->uuid('global_id')->index()->unique();
            $table->string('post')->nullable();
            $table->string('name')->nullable();

            $table->foreign('organization_id')->references('id')->on('timetable_widget_organizations')->restrictOnDelete();
        });

        Schema::create('timetable_widget_timetables', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->index();
            $table->integer('month')->index();
            $table->integer('day')->index();
            $table->string('status', 5)->nullable();
            $table->uuid('employee_global_id')->index();

            $table->foreign('employee_global_id')->references('global_id')->on('timetable_widget_employees')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timetable_widget_timetables');
        Schema::dropIfExists('timetable_widget_employees');
        Schema::dropIfExists('timetable_widget_organizations');
    }
};
