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
        Schema::create('phone_book_widget_phonebook_records', function (Blueprint $table) {
            $table->id();
            $table->string('fio')->index();
            $table->string('city')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('post')->nullable()->comment('Должность');
            $table->string('administration_body_name')->nullable()->comment('Наименование органа администрации');
            $table->string('management_department')->nullable()->comment('Отдел управления');
            $table->unsignedBigInteger('od_api_id');

            //Т.к. автоматически генерится очень длинный индекс - ошибка
            $table->index('administration_body_name', 'pbw_records_admin_body_name_idx');

            $table->foreign('od_api_id')->references('id')->on('phone_book_widget_od_datasets')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_book_widget_phonebook_records');
    }
};
