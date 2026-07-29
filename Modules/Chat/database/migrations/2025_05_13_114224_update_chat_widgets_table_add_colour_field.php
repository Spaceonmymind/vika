<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {

        Schema::table('chat_widgets', function (Blueprint $table) {
            $table->string('bg_colour',9)->nullable()->after('url');
        });

        Schema::table('chat_widget_categories', function (Blueprint $table) {
            $table->string('bg_colour',9)->nullable()->after('order');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('chat_widgets', function (Blueprint $table) {
            $table->dropColumn('bg_colour');
        });
        Schema::table('chat_widget_categories', function (Blueprint $table) {
            $table->dropColumn('bg_colour');
        });
    }
};
