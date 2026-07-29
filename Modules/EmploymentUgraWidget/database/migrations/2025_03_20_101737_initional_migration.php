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
        Schema::create('employment_ugra_widget_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('employment_ugra_widget_questions', function (Blueprint $table) {
            $table->id();
            $table->mediumText('question');
            $table->mediumText('answer');
            $table->unsignedBigInteger('category_id');

            $table->foreign('category_id')->references('id')->on('employment_ugra_widget_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_ugra_widget_questions');
        Schema::dropIfExists('employment_ugra_widget_categories');
    }
};
