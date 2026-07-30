<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stop_graffiti_reports', function (Blueprint $table) {
            $table->id();
            $table->string('external_id')->unique();
            $table->dateTimeTz('reported_at');
            $table->bigInteger('max_user_id')->index();
            $table->bigInteger('max_recipient_id');
            $table->boolean('recipient_is_chat');
            $table->string('category');
            $table->text('address');
            $table->text('comment')->nullable();
            $table->string('status')->default('new')->index();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('received_at');
            $table->timestamps();
        });

        Schema::create('stop_graffiti_report_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('stop_graffiti_reports')->cascadeOnDelete();
            $table->string('type');
            $table->json('payload');
            $table->string('archive_status')->default('pending')->index();
            $table->string('storage_path')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('size')->nullable();
            $table->text('archive_error')->nullable();
            $table->timestamps();
        });

        Schema::create('stop_graffiti_report_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('stop_graffiti_reports')->cascadeOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('comment')->nullable();
            $table->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stop_graffiti_report_status_history');
        Schema::dropIfExists('stop_graffiti_report_media');
        Schema::dropIfExists('stop_graffiti_reports');
    }
};
