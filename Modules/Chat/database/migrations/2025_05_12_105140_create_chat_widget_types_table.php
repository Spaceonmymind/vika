<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Chat\Database\Seeders\ChatWidgetTypesTableSeeder;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_widget_types', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
        });

        (new ChatWidgetTypesTableSeeder())->run();


        Schema::dropIfExists('chat_widget_vika_type');

        Schema::create('chat_widget_icons', function (Blueprint $table) {
            $table->id();

            $table->string('code');
            $table->string('name');
        });

        Schema::create('chat_widget_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->unsignedBigInteger('vika_type_id');
            $table->integer('order')->default(1000);

            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
            $table->foreign('icon_id')->references('id')->on('chat_widget_icons')->nullOnDelete();
        });

        Schema::create('chat_attached_to_vika_type_widgets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('chat_widget_id');
            $table->unsignedBigInteger('vika_type_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->integer('order')->default(1000);

            $table->foreign('chat_widget_id')->references('id')->on('chat_widgets')->cascadeOnDelete();
            $table->foreign('vika_type_id')->references('id')->on('chat_vika_types')->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('chat_widget_categories')->nullOnDelete();
        });

        Schema::table('chat_widgets', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->default(1);
            $table->unsignedBigInteger('icon_id')->nullable();
            $table->string('url',1000)->nullable();

            $table->foreign('type_id')->references('id')->on('chat_widget_types');
            $table->foreign('icon_id')->references('id')->on('chat_widget_icons')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('chat_widgets', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
            $table->dropForeign(['icon_id']);

            $table->dropColumn('type_id');
            $table->dropColumn('icon_id');
            $table->dropColumn('url');
        });

        Schema::dropIfExists('chat_attached_to_vika_type_widgets');
        Schema::dropIfExists('chat_widget_categories');
        Schema::dropIfExists('chat_widget_icons');
        Schema::dropIfExists('chat_widget_types');
    }
};
