<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_max_subscription_event_types', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50)->unique()->comment('Тип события (актировки, талоны и т.д.)');
            $table->string('description')->nullable();
        });

        Schema::create('chat_max_user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->integer('chat_id');
            $table->integer('user_id')->nullable();
            $table->unsignedBigInteger('event_type_id')->index();
            $table->json('extra_params')->nullable()->comment('Дополнительные параметры (город и т.п.) подписки в формате JSON');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('event_type_id')->references('id')->on('chat_max_subscription_event_types')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_max_user_subscriptions');
        Schema::dropIfExists('chat_max_subscription_event_types');
    }
};
