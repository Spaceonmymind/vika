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
        Schema::table('chat_max_web_app_urls',function (Blueprint $table) {
            $table->unsignedBigInteger('widget_id')->nullable()->change();
        });
        Schema::table('chat_widget_usage_history_records',function (Blueprint $table) {
            $table->boolean('from_max')->default(false)->after('from_tg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_widget_usage_history_records',function (Blueprint $table) {
            $table->dropColumn('from_max');
        });
    }
};
