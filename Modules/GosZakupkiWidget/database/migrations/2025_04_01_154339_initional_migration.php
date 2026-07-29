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
        Schema::create('gos_zakupki_widget_question_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('gos_zakupki_widget_questions', function (Blueprint $table) {
            $table->id();
            $table->mediumText('question');
            $table->mediumText('answer')->nullable();
            $table->string('link')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('gos_zakupki_widget_question_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gos_zakupki_widget_questions');
        Schema::dropIfExists('gos_zakupki_widget_question_categories');
    }
};
