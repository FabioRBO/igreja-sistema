<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('inventory_category_id')
                ->constrained('inventory_categories')
                ->restrictOnDelete();

            $table->string('name');

            $table->string('asset_code')
                ->nullable();

            $table->unsignedInteger('quantity')
                ->default(1);

            $table->string('location')
                ->nullable();

            $table->string('condition', 30)
                ->nullable();

            $table->date('acquisition_date')
                ->nullable();

            $table->decimal('value', 12, 2)
                ->nullable();

            $table->text('notes')
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index([
                'church_id',
                'inventory_category_id',
            ]);

            $table->index('asset_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};