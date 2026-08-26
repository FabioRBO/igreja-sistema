<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worship_schedules', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->date('schedule_date');

            $table->string('service_type', 30);

            $table->time('start_time')->nullable();

            $table->string('title')->nullable();

            $table->text('notes')->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'schedule_date']);
            $table->index(['service_type', 'schedule_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worship_schedules');
    }
};