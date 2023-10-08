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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('health')->default(100);
            $table->unsignedBigInteger('max_health')->default(100);
            $table->foreignIdFor(\App\Models\User::class)->nullable()->constrained();
            $table->unsignedBigInteger('experience')->default(0);
            $table->unsignedBigInteger('lockpicking')->default(0);
            $table->unsignedBigInteger('hacking')->default(0);
            $table->unsignedBigInteger('stealth')->default(0);
            $table->unsignedBigInteger('combat')->default(0);
            $table->unsignedBigInteger('forgery')->default(0);
            $table->unsignedBigInteger('safecracking')->default(0);
            $table->unsignedBigInteger('medicine')->default(0);
            $table->unsignedBigInteger('driving')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
