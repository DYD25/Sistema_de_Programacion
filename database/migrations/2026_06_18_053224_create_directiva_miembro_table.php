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
        Schema::create('directiva_miembro', function (Blueprint $table) {
            $table->id();
            $table->foreignId('directiva_id');
            $table->foreignId('miembro_id');
            $table->foreignId('cargo_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directiva_miembro');
    }
};
