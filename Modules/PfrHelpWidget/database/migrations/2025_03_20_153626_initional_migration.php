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
        Schema::create('pfr_help_widget_services',function (Blueprint $table){
            $table->id();
            $table->string('name');
        });
        Schema::create('pfr_help_widget_question_categories',function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('service_id');

            $table->foreign('service_id')->references('id')->on('pfr_help_widget_services')->cascadeOnDelete();
        });
        Schema::create('pfr_help_widget_questions',function (Blueprint $table){
            $table->id();
            $table->mediumText('question');
            $table->mediumText('answer');
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->references('id')->on('pfr_help_widget_question_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pfr_help_widget_questions');
        Schema::dropIfExists('pfr_help_widget_question_categories');
        Schema::dropIfExists('pfr_help_widget_services');
    }
};
