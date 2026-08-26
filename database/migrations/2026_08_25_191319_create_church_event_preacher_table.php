<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('church_event_preacher', function (Blueprint $table) {
            $table->id();

            $table->foreignId('church_event_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('preacher_id')
                ->constrained()
                ->restrictOnDelete();

            $table->timestamps();

            $table->unique(
                ['church_event_id', 'preacher_id'],
                'church_event_preacher_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_event_preacher');
    }
};