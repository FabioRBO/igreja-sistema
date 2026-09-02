<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('logistics_loan_id')
                ->nullable()
                ->constrained('logistics_loans')
                ->nullOnDelete();

            $table->foreignId('inventory_item_id')
                ->constrained('inventory_items')
                ->restrictOnDelete();

            $table->foreignId('responsible_person_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            $table->string('type', 20);

            $table->unsignedInteger('quantity')
                ->default(1);

            $table->date('movement_date');

            $table->string('condition', 30)
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(
                ['inventory_item_id', 'type'],
                'log_delivery_item_type_idx'
            );

            $table->index(
                ['church_id', 'movement_date'],
                'log_delivery_church_date_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_deliveries');
    }
};