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
        Schema::create('arrivals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('event_day_id')
                ->constrained('event_days')
                ->cascadeOnDelete();

            $table->foreignId('loft_id')
                ->constrained('lofts')
                ->cascadeOnDelete();

            // 1..10 (dynamic per tournament)
            $table->unsignedTinyInteger('pigeon_no');

            // time entered by admin
            $table->time('arrival_time')->nullable();

            // calculated seconds from start_time
            $table->unsignedInteger('duration_seconds')->nullable();

            $table->timestamps();

            // same pigeon_no only once for a loft/day
            $table->unique(['event_day_id', 'loft_id', 'pigeon_no']);
            $table->index(['event_day_id', 'loft_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arrivals');
    }
};
