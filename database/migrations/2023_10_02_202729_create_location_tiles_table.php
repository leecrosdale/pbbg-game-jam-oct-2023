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
        Schema::create('location_tiles', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Location::class)->constrained();
            $table->foreignIdFor(\App\Models\Tile::class)->constrained();
            $table->unsignedBigInteger('x');
            $table->unsignedBigInteger('y');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('location_tiles');
    }
};
