<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('actirovki_widget_weathers', static function (Blueprint $table) {
            $table->dropIndex(['receiving_at']);

            $table->index(['city_id', 'created_at']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::table('actirovki_widget_weathers', static function (Blueprint $table) {
            $table->index('city_id', 'actirovki_widget_weathers_city_id_foreign');
            $table->index('received_at', 'actirovki_widget_weathers_receiving_at_index');
            $table->dropIndex(['city_id_created_at']);
            $table->dropIndex(['created_at']);
        });
    }
};
