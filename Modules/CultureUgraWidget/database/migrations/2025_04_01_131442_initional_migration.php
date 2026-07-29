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
        Schema::create('culture_ugra_widget_localities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('culture_ugra_widget_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('locality_id');
            $table->mediumText('description')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->mediumText('organization_name')->nullable();
            $table->mediumText('address')->nullable();
            $table->string('buy_link')->nullable();
            $table->string('buy_text')->nullable();

            $table->foreign('locality_id')->references('id')->on('culture_ugra_widget_localities')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('culture_ugra_widget_events');
        Schema::dropIfExists('culture_ugra_widget_localities');
    }
};
