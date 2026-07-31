<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('subject_offering_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedInteger('lesson_number')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('lesson_date');
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('room')->nullable();

            $table->string('qr_token', 100)->nullable()->unique();
            $table->boolean('qr_enabled')->default(false);
            $table->timestamp('qr_expires_at')->nullable();

            $table->string('status', 30)->default('scheduled');
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'lesson_date']);
            $table->index(['subject_offering_id', 'lesson_date']);
            $table->index(['status', 'lesson_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
