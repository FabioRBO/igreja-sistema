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
        Schema::create('baptisms', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('person_id')
                ->constrained()
                ->restrictOnDelete();

            $table->date('baptism_date');

            $table->string('location')->nullable();
            $table->string('officiant')->nullable();

            $table->string('certificate_number')->nullable()->unique();

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique('person_id', 'baptism_person_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baptisms');
    }
};
