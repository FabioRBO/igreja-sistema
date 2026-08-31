<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cell_meeting_attendances', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('cell_meeting_id')
                ->constrained('cell_meetings')
                ->cascadeOnDelete();

            $table->foreignId('person_id')
                ->constrained('people')
                ->restrictOnDelete();

            $table->boolean('is_present')
                ->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(
                ['cell_meeting_id', 'person_id'],
                'cell_meeting_person_unique'
            );

            $table->index(['person_id', 'is_present']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cell_meeting_attendances');
    }
};