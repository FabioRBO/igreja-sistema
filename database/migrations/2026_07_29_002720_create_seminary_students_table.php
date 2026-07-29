<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seminary_students', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('person_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('registration_number')->nullable()->unique();

            $table->date('enrollment_date')->nullable();

            $table->string('status')->default('ativo');

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique('person_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seminary_students');
    }
};
