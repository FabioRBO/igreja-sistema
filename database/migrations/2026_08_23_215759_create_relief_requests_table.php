<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('relief_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('assisted_person_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('type', 50);

            $table->timestamp('requested_at')
                ->useCurrent();

            $table->string('priority', 20)
                ->default('normal');

            $table->text('description')->nullable();

            $table->foreignId('responsible_person_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            $table->string('status', 30)
                ->default('open');

            $table->timestamp('completed_at')
                ->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'status']);
            $table->index(['type', 'status']);
            $table->index(['priority', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('relief_requests');
    }
};