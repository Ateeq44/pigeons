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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('club_id')
                ->constrained('clubs')
                ->cascadeOnDelete();

            $table->string('title_ur');                      // tournament title
            $table->time('start_time');                      // e.g. 05:30:00
            $table->date('start_date');
            $table->date('end_date');

            // ✅ Dynamic pigeons 1..10 (per tournament)
            $table->unsignedTinyInteger('pigeons_per_loft')->default(5);

            // Home page featured
            $table->boolean('is_featured')->default(false);

            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['club_id', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
