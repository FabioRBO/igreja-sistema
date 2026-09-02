<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_loans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('logistics_request_id')
                ->nullable()
                ->constrained('logistics_requests')
                ->nullOnDelete();

            $table->foreignId('logistics_reservation_id')
                ->nullable()
                ->constrained('logistics_reservations')
                ->nullOnDelete();

            $table->foreignId('inventory_item_id')
                ->constrained('inventory_items')
                ->restrictOnDelete();

            $table->foreignId('responsible_person_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            $table->unsignedInteger('quantity')
                ->default(1);

            $table->date('loan_date');

            $table->date('expected_return_date')
                ->nullable();

            $table->date('return_date')
                ->nullable();

            $table->string('status', 30)
                ->default('loaned');

            $table->string('condition_on_loan', 30)
                ->nullable();

            $table->string('condition_on_return', 30)
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(
                ['inventory_item_id', 'status'],
                'log_loan_item_status_idx'
            );

            $table->index(
                ['responsible_person_id', 'status'],
                'log_loan_person_status_idx'
            );

            $table->index(
                ['loan_date', 'expected_return_date'],
                'log_loan_dates_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_loans');
    }
};