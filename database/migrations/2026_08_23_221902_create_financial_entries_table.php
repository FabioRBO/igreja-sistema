<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_entries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('financial_category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('financial_account_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('person_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // income = conta a receber
            // expense = conta a pagar
            $table->string('type', 20);

            $table->string('description');

            $table->date('competence_date')->nullable();
            $table->date('due_date')->nullable();

            $table->decimal('amount', 15, 2);

            $table->decimal('paid_amount', 15, 2)
                ->default(0);

            $table->timestamp('payment_date')->nullable();

            $table->string('payment_method', 30)->nullable();

            // pending, partial, paid, cancelled
            $table->string('status', 30)->default('pending');

            $table->string('document_number', 100)->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'type', 'status']);
            $table->index(['church_id', 'due_date']);
            $table->index(['financial_category_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_entries');
    }
};