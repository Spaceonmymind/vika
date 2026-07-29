<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('chat_answers')->delete();
        Schema::table('chat_answers', function (Blueprint $table) {
            $table->dropColumn('answer_message_text');
            $table->unsignedBigInteger('vika_type_id');

            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();

            $table->unique(['vika_type_id', 'intent_id']);
        });

        Schema::dropIfExists('chat_answer_vika_type');

        Schema::create('chat_answer_texts',function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->unsignedBigInteger('answer_id');
            $table->foreign('answer_id')->references('id')->on('chat_answers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('chat_answers')->delete();

        Schema::table('chat_answers', function (Blueprint $table) {


            $table->dropForeign(['vika_type_id']);

            $table->dropUnique(['vika_type_id', 'intent_id']);
            $table->text('answer_message_text');
            $table->dropColumn('vika_type_id');
        });

        Schema::create('chat_answer_vika_type', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_answer_id');
            $table->unsignedBigInteger('vika_type_id');

            $table->foreign('chat_answer_id')->references('id')->on('chat_answers')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
        });
        Schema::dropIfExists('chat_answer_texts');
    }
};
