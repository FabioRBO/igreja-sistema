<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('church_events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->foreignId('church_id')
                ->constrained()
                ->restrictOnDelete();

            $table->foreignId('event_type_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('title');

            $table->date('event_date');

            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            $table->string('location')->nullable();

            $table->text('description')->nullable();

            $table->string('youtube_url')->nullable();

            $table->string('banner')->nullable();

            // Já preparando para o CMS
            $table->boolean('publish_on_site')
                ->default(false);

            $table->boolean('is_active')
                ->default(true);

            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['church_id', 'event_date']);
            $table->index(['event_type_id', 'event_date']);
            $table->index(['publish_on_site', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_events');
    }
};