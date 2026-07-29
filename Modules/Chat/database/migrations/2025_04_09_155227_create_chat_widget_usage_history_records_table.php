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
        Schema::create('chat_widget_usage_history_records', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->boolean('from_tg')->default(false);
            $table->unsignedBigInteger('widget_id');
            $table->timestamp('called_at');

            $table->foreign('widget_id')->references('id')->on('chat_widgets')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_widget_usage_history_records');
    }
};
