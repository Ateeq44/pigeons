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
        Schema::create('lofts', function (Blueprint $table) {
            $table->id();

            $table->string('name_ur');                // participant name
            $table->string('city_ur')->nullable();    // city
            $table->string('photo_path')->nullable(); // stored in /storage

            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['name_ur', 'city_ur']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lofts');
    }
};
