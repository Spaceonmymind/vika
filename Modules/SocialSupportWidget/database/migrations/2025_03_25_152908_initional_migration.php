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
        Schema::create('social_support_widget_od_datasets',function (Blueprint $table){
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
        Schema::create('social_support_widget_preferential_categories',function (Blueprint $table){
            $table->id();
            $table->string('name');
        });

        Schema::create('social_support_widget_situations',function (Blueprint $table){
            $table->id();
            $table->string('name');
        });
        Schema::create('social_support_widget_social_support_measures',function (Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('situation_id')->nullable();
            $table->mediumText('name');
            $table->mediumText('conditions');
            $table->mediumText('amount_and_deadlines')->nullable();
            $table->mediumText('law')->nullable();
            $table->mediumText('min_amount')->nullable();
            $table->mediumText('max_amount')->nullable();
            $table->integer('max_family_income')->nullable();
            $table->integer('min_child_age')->nullable();
            $table->integer('max_child_age')->nullable();
            $table->integer('live_in_ugra_years')->nullable();
            $table->date('create_date');
            $table->date('update_date');

            $table->foreign('situation_id','s_w_s_s_m_s_fk')->references('id')->on('social_support_widget_situations')->cascadeOnDelete();
        });
        Schema::create('social_support_widget_preferential_category_measure',function (Blueprint $table){
            $table->unsignedBigInteger('measure_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('measure_id','s_s_w_p_c_s_s_m_m_fk')->references('id')->on('social_support_widget_social_support_measures')->cascadeOnDelete();
            $table->foreign('category_id','s_s_w_p_c_s_s_m_c_fk')->references('id')->on('social_support_widget_preferential_categories')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_support_widget_preferential_category_measure');
        Schema::dropIfExists('social_support_widget_social_support_measures');
        Schema::dropIfExists('social_support_widget_situations');
        Schema::dropIfExists('social_support_widget_preferential_categories');
        Schema::dropIfExists('social_support_widget_od_datasets');

    }
};
