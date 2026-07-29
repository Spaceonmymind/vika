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
        Schema::create('chat_max_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('chat_id');
            $table->integer('user_id');
            $table->string('message',2000)->nullable();
            $table->string('username',255)->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->json('answer')->nullable();
            $table->timestamp('created_at');
        });
        Schema::create('chat_max_web_app_urls',function (Blueprint $table) {;
            $table->id();
            $table->unsignedBigInteger('widget_id');
            $table->json('params');
            $table->foreign('widget_id')->references('id')->on('chat_widgets')->onDelete('cascade');
        });
        Schema::table('chat_intent_history_records', function (Blueprint $table) {
            $table->boolean('from_max')->default(false)->after('from_tg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_max_messages');
        Schema::dropIfExists('chat_max_web_app_urls');
        Schema::table('chat_intent_history_records', function (Blueprint $table) {
            $table->dropColumn('from_max');
        });
    }
};
