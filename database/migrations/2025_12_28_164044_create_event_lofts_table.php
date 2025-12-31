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
        Schema::create('event_lofts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('loft_id')
                ->constrained('lofts')
                ->cascadeOnDelete();

            // Total pigeons for this loft in this event (optional)
            $table->unsignedTinyInteger('pigeons_total')->nullable(); // e.g. 35

            // Prize money (optional)
            $table->unsignedInteger('prize_amount')->nullable(); // e.g. 150000

            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            // same loft cannot be attached twice to same event
            $table->unique(['event_id', 'loft_id']);
            $table->index(['event_id', 'loft_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_lofts');
    }
};
