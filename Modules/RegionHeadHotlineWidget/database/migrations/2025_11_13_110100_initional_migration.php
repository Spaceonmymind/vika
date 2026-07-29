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
        Schema::create('region_head_hotline_widget_bad_words', function (Blueprint $table) {
            $table->id();
            $table->string('word');
            $table->string('pattern');
        });

        Schema::create('region_head_hotline_widget_appeals', function (Blueprint $table) {
            $table->id();
            $table->integer('max_user_id');
            $table->unsignedBigInteger('external_id');
        });

        Schema::create('region_head_hotline_widget_max_contacts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unique();
            $table->string('phone',11);
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('region_head_hotline_widget_bad_words');
        Schema::dropIfExists('region_head_hotline_widget_appeals');
        Schema::dropIfExists('region_head_hotline_widget_max_contacts');
    }
};
