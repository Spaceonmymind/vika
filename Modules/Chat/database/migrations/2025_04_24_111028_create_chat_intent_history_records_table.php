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
        Schema::create('chat_intent_history_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intent_id')->nullable();
            $table->string('intent_code');
            $table->string('intent_name');
            $table->string('message');
            $table->string('chat_id');
            $table->json('entities');
            $table->timestamps();

            $table->foreign('intent_id')->references('id')->on('chat_intents')->nullOnDelete();
        });

        Schema::table('chat_intents', function (Blueprint $table) {
            $table->unsignedBigInteger('external_id')->nullable();
        });

        Schema::create('chat_intent_test_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intent_id');
            $table->string('text');
            $table->unsignedBigInteger('external_id');
            $table->timestamps();

            $table->foreign('intent_id')->references('id')->on('chat_intents')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_intent_history_records');
        Schema::dropIfExists('chat_intent_test_requests');

        Schema::table('chat_intents', function (Blueprint $table) {
            $table->dropColumn('external_id');
        });
    }
};
