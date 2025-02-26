<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('actor_pelicula', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelicula_id')->constrained()->onDelete('cascade');
            $table->foreignId('actor_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Evitar que un actor esté dos veces en la misma película
            $table->unique(['pelicula_id', 'actor_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('actor_pelicula');
    }
};
