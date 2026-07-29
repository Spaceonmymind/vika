<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('actirovki_widget_rows', static function (Blueprint $table) {
            // Создаем новый составной индекс по city_id и created_at
            $table->index(['city_id', 'created_at'], 'idx_city_created_at');
        });
    }

    public function down(): void
    {
        Schema::table('actirovki_widget_rows', static function (Blueprint $table) {
            Schema::disableForeignKeyConstraints();
            // Удаляем составной индекс
            $table->dropIndex('idx_city_created_at');
        });
    }
};
