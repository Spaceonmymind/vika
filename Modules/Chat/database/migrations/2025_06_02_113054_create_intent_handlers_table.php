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
        Schema::create('chat_intent_handlers', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('class');
        });
        Schema::table('chat_intents', function (Blueprint $table) {
            $table->unsignedBigInteger('handler_id')->nullable()->after('active');

            $table->foreign('handler_id')->references('id')->on('chat_intent_handlers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_intents', function (Blueprint $table) {
            $table->dropForeign(['handler_id']);
            $table->dropColumn('handler_id');
        });
        Schema::dropIfExists('chat_intent_handlers');
    }
};
