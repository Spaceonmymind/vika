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
        Schema::table('chat_max_web_app_urls', function (Blueprint $table) {
            $table->uuid('guid')->nullable()->after('id')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_max_web_app_urls', function (Blueprint $table) {
            $table->dropUnique(['guid']);
            $table->dropColumn('guid');
        });
    }
};
