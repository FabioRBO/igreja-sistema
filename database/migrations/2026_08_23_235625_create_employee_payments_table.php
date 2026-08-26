<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_payments', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('employee_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('financial_account_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('competence', 7); // Ex.: 2026-08

            $table->date('due_date')->nullable();

            $table->decimal('base_amount', 15, 2)->default(0);
            $table->decimal('additions', 15, 2)->default(0);
            $table->decimal('discounts', 15, 2)->default(0);
            $table->decimal('net_amount', 15, 2)->default(0);

            $table->timestamp('payment_date')->nullable();

            $table->string('payment_method', 30)->nullable();

            $table->string('status', 30)->default('pending');

            $table->foreignId('financial_entry_id')
                ->nullable()
                ->constrained('financial_entries')
                ->nullOnDelete();

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['employee_id', 'competence']);
            $table->index(['status', 'due_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_payments');
    }
};