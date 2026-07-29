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
        Schema::create('chat_telegram_messages', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->bigInteger('chat_id')->comment('chat_id и user_id одинаковы');
            $table->string('username')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
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
        Schema::dropIfExists('chat_telegram_messages');
    }
};
