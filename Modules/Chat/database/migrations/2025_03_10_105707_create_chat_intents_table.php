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
        Schema::create('chat_intents', function (Blueprint $table) {
           $table->id();
           $table->string('code');
           $table->string('name');
           $table->string('custom_handler_class')->nullable()->comment('Хэндлер, который будет обрабатывать текст ответа в чат');
           $table->boolean('active')->default(false);
        });

        Schema::create('chat_answers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('intent_id');
            $table->text('answer_message_text');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('intent_id')->references('id')->on('chat_intents')->cascadeOnDelete();

        });

        Schema::create('chat_intent_vika_type', function (Blueprint $table) {
            $table->unsignedBigInteger('intent_id');
            $table->unsignedBigInteger('vika_type_id');

            $table->foreign('intent_id')->references('id')->on('chat_intents')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
        });

        Schema::create('chat_answer_vika_type', function (Blueprint $table) {
            $table->unsignedBigInteger('chat_answer_id');
            $table->unsignedBigInteger('vika_type_id');

            $table->foreign('chat_answer_id')->references('id')->on('chat_answers')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
        });

        Schema::create('chat_answer_button_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        Schema::create('chat_answer_buttons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('button_type_id');
            $table->string('name');
            $table->unsignedBigInteger('answer_id');
            $table->string('button_message_text',200);
            $table->text('url')->nullable();
            $table->unsignedBigInteger('chat_widget_id')->nullable();
            $table->timestamps();

            $table->foreign('answer_id')->references('id')->on('chat_answers')->cascadeOnDelete();
            $table->foreign('button_type_id')->references('id')->on('chat_answer_button_types')->cascadeOnDelete();
            $table->foreign('chat_widget_id')->references('id')->on('chat_widgets')->cascadeOnDelete();
        });
        Schema::create('chat_answer_button_entities',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('button_id');
            $table->string('name');
            $table->string('code');
            $table->string('param_name');
            $table->boolean('multiple');
            $table->string('table')->nullable();
            $table->string('search_column')->nullable();
            $table->string('value_column')->nullable();
            $table->timestamps();

            $table->foreign('button_id')->references('id')->on('chat_answer_buttons')->cascadeOnDelete();

            $table->unique(['button_id','code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_answer_vika_type');
        Schema::dropIfExists('chat_intent_vika_type');
        Schema::dropIfExists('chat_answer_button_entities');
        Schema::dropIfExists('chat_answer_buttons');
        Schema::dropIfExists('chat_answers');
        Schema::dropIfExists('chat_intents');
        Schema::dropIfExists('chat_answer_button_types');
    }
};
