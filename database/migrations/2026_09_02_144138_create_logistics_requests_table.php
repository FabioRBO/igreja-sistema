<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_requests', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('requester_person_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            $table->string('title');

            $table->text('description')
                ->nullable();

            $table->date('request_date');

            $table->date('needed_date')
                ->nullable();

            $table->date('return_date')
                ->nullable();

            $table->string('status', 30)
                ->default('pending');

            $table->string('destination')
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'church_id',
                'status',
            ]);

            $table->index([
                'needed_date',
                'return_date',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_requests');
    }
};