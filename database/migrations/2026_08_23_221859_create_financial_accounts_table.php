<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('financial_accounts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('name');

            // cash, checking, savings, digital, other
            $table->string('type', 30)->default('cash');

            $table->string('bank_name')->nullable();
            $table->string('agency', 30)->nullable();
            $table->string('account_number', 50)->nullable();
            $table->string('pix_key')->nullable();

            $table->decimal('initial_balance', 15, 2)->default(0);

            $table->boolean('is_active')->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'is_active']);
            $table->index(['church_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('financial_accounts');
    }
};