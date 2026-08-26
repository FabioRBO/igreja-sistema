<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('person_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('position');

            $table->string('employment_type', 30);

            $table->date('admission_date')->nullable();

            $table->decimal('base_amount', 15, 2)
                ->default(0);

            $table->string('payment_frequency', 30)
                ->default('monthly');

            $table->boolean('is_active')
                ->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'is_active']);
            $table->index('employment_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};