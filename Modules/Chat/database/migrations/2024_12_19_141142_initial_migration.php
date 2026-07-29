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
        Schema::create('chat_vika_types', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64)->index();
            $table->string('description')->nullable();
        });

        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->uuid('chat_id');
            $table->unsignedBigInteger('vika_type_id');
            $table->json('answer')->nullable();
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
        Schema::dropIfExists('chat_vika_types');
    }
};
