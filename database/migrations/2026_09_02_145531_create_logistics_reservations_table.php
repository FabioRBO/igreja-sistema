<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_reservations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('logistics_request_id')
                ->nullable()
                ->constrained('logistics_requests')
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

            $table->date('start_date');

            $table->date('end_date')
                ->nullable();

            $table->string('status', 30)
                ->default('reserved');

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(
                ['inventory_item_id', 'start_date', 'end_date'],
                'log_res_item_dates_idx'
            );

            $table->index(
                ['church_id', 'status'],
                'log_res_church_status_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_reservations');
    }
};