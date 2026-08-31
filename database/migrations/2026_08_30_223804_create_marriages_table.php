<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marriages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('person_one_id')
                ->constrained('people')
                ->restrictOnDelete();

            $table->foreignId('person_two_id')
                ->constrained('people')
                ->restrictOnDelete();

            $table->date('marriage_date');

            $table->boolean('is_active')
                ->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'marriage_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marriages');
    }
};