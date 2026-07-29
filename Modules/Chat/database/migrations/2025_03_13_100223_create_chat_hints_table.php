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

        Schema::create('chat_hints', function (Blueprint $table) {
            $table->id();
            $table->string('value');
        });
        Schema::create('chat_hint_vika_type', function (Blueprint $table) {
            $table->unsignedBigInteger('hint_id');
            $table->unsignedBigInteger('vika_type_id');

            $table->foreign('hint_id')->references('id')->on('chat_hints')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_hint_vika_type');
        Schema::dropIfExists('chat_hints');
    }
};
