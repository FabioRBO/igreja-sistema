<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('inventory_item_id')
                ->constrained('inventory_items')
                ->restrictOnDelete();

            $table->string('type', 30);

            $table->unsignedInteger('quantity')
                ->default(1);

            $table->date('movement_date');

            $table->string('origin')
                ->nullable();

            $table->string('destination')
                ->nullable();

            $table->foreignId('responsible_person_id')
                ->nullable()
                ->constrained('people')
                ->nullOnDelete();

            $table->text('notes')
                ->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'church_id',
                'movement_date',
            ]);

            $table->index([
                'inventory_item_id',
                'type',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};