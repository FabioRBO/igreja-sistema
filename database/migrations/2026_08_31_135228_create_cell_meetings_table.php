<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cell_meetings', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('cell_id')
                ->constrained('cells')
                ->restrictOnDelete();

            $table->date('meeting_date');

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'meeting_date']);
            $table->index(['cell_id', 'meeting_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cell_meetings');
    }
};