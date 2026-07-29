<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('actirovki_widget_weathers', static function (Blueprint $table) {
            $table->renameColumn('receiving_at', 'received_at');
        });
    }

    public function down(): void
    {
        Schema::table('actirovki_widget_weathers', static function (Blueprint $table) {
            $table->renameColumn('received_at', 'receiving_at');
        });
    }
};
