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
        Schema::table('chat_intent_history_records', function (Blueprint $table) {
            $table->dropColumn('intent_code');
            $table->dropColumn('intent_name');
            $table->dropForeign(['intent_id']);
            $table->unsignedBigInteger('vika_type_id')->nullable()->after('intent_id');
            $table->boolean('from_tg')->default(false)->after('vika_type_id');
            $table->foreign('intent_id')->references('id')->on('chat_intents')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_intent_history_records', function (Blueprint $table) {
            $table->string('intent_code')->nullable()->after('intent_id');
            $table->string('intent_name')->nullable()->after('intent_code');
            $table->dropForeign(['vika_type_id']);
            $table->dropColumn('vika_type_id');
            $table->dropColumn('from_tg');
        });
    }
};
