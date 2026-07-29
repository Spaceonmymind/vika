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
        Schema::table('chat_max_messages', static function (Blueprint $table) {
            $table->string('message', 4096)->nullable()->change();
        });

        Schema::table('chat_telegram_messages', static function (Blueprint $table) {
            $table->string('message', 4096)->change();
        });

        Schema::table('chat_messages', static function (Blueprint $table) {
            $table->string('message', 4096)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_max_messages', static function (Blueprint $table) {
            $table->string('message', 2000)->nullable()->change();
        });

        Schema::table('chat_telegram_messages', static function (Blueprint $table) {
            $table->string('message')->change();
        });

        Schema::table('chat_messages', static function (Blueprint $table) {
            $table->string('message', 2000)->nullable()->change();
        });
    }
};
