<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('chat_intent_history_records', static function (Blueprint $table) {
            $table->string('message', 4096)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('chat_intent_history_records', static function (Blueprint $table) {
            $table->string('message', 2000)->nullable()->change();
        });
    }
};
