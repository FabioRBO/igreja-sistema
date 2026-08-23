<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_categories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('name');

            // income = receita
            // expense = despesa
            // both = ambos
            $table->string('type', 20)->default('both');

            $table->text('description')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'type']);
            $table->index(['church_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_categories');
    }
};