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
        Schema::create('chat_widget_vika_type', function (Blueprint $table) {
            $table->unsignedBigInteger('widget_id');
            $table->unsignedBigInteger('vika_type_id');

            $table->foreign('widget_id')->references('id')->on('chat_widgets')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_widget_vika_type');
    }
};
