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
        Schema::table('phone_book_widget_phonebook_records', function (Blueprint $table) {
            $table->dropIndex('pbw_records_fulltext_index');
            $table->fullText(['fio'], 'pbw_fio_fulltext_index');
            $table->fullText(['administration_body_name'], 'pbw_abn_fulltext_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('phone_book_widget_phonebook_records', function (Blueprint $table) {
            $table->dropIndex('pbw_fio_fulltext_index');
            $table->dropIndex('pbw_abn_fulltext_index');

            $table->fullText(['fio', 'administration_body_name'], 'pbw_records_fulltext_index');
        });
    }
};
