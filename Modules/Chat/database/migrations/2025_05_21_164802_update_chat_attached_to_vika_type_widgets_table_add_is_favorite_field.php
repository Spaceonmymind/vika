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
        Schema::table('chat_attached_to_vika_type_widgets', function (Blueprint $table) {
           $table->boolean('is_favorite')->default(0);
        });

        Schema::table('chat_widget_categories', function (Blueprint $table) {
           $table->boolean('is_favorite')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_attached_to_vika_type_widgets', function (Blueprint $table) {
            $table->dropColumn('is_favorite');
        });
        Schema::table('chat_widget_categories', function (Blueprint $table) {
            $table->dropColumn('is_favorite');
        });
    }
};
