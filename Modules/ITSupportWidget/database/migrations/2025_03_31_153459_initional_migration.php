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
        Schema::create('it_support_widget_od_datasets', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->string('data_type', 5)->default('json')->comment('Тип данных');
            $table->string('class_handler')->comment('Класс обработчика');
            $table->text('description')->nullable();
            $table->boolean('need_update')->default(false)->comment('Принудительное обновление');
            $table->boolean('is_active')->default(false);
            $table->string('current_hash', 32)->nullable();
            $table->timestamp('last_update')->nullable();
        });
        Schema::create('it_support_widget_measures', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->string('type')->nullable();
            $table->mediumText('conditions');
            $table->mediumText('terms')->nullable();
            $table->mediumText('responsible')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('it_support_widget_measures');
        Schema::dropIfExists('it_support_widget_od_datasets');
    }
};
