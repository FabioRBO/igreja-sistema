<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logistics_request_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('logistics_request_id')
                ->constrained('logistics_requests')
                ->cascadeOnDelete();

            $table->foreignId('inventory_item_id')
                ->constrained('inventory_items')
                ->restrictOnDelete();

            $table->unsignedInteger('quantity')
                ->default(1);

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(
                ['logistics_request_id', 'inventory_item_id'],
                'log_req_item_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logistics_request_items');
    }
};