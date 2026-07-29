<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chat_intent_history_records', function (Blueprint $table) {
            $table->date('created_at_date')->virtualAs('DATE(created_at)');
            $table->index('created_at_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_intent_history_records', function (Blueprint $table) {
            $table->dropIndex(['created_at_date']);
            $table->dropColumn('created_at_date');
        });
    }
};
