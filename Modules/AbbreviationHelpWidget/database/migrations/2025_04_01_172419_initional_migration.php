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
        Schema::create('abbreviation_help_widget_abbreviations', function (Blueprint $table) {
            $table->id();
            $table->string('abbreviation');
            $table->string('decoding',1000);
            $table->mediumText('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abbreviation_help_widget_abbreviations');
    }
};
