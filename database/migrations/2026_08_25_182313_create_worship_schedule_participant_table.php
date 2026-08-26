<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('worship_schedule_participant', function (Blueprint $table) {
            $table->id();

            $table->foreignId('worship_schedule_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('worship_participant_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('role', 30)->nullable();

            $table->string('instrument')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(
                ['worship_schedule_id', 'worship_participant_id'],
                'worship_schedule_participant_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('worship_schedule_participant');
    }
};