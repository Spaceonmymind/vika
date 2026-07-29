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

        Schema::table('chat_intents', function (Blueprint $table) {
            $table->string('custom_handler_class')->nullable()->default('Modules\\\\Chat\\\\IntentHandlers\\\\DefaultChatHandler')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
