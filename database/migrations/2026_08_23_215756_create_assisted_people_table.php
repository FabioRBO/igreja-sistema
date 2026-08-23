<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assisted_people', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('person_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('name');
            $table->string('phone', 30)->nullable();
            $table->string('address')->nullable();

            $table->text('family_situation')->nullable();
            $table->text('notes')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'is_active']);
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assisted_people');
    }
};