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
        Schema::table('chat_intents', function (Blueprint $table) {
            $table->mediumText('document')->nullable()->after('external_id');
            $table->mediumText('system_prompt')->nullable()->after('document');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_intents', function (Blueprint $table) {
            $table->dropColumn(['document', 'system_prompt']);
        });
    }
};
