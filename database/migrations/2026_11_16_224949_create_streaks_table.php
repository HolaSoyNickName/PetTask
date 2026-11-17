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
        Schema::create('streaks', function (Blueprint $table) {
    $table->id();
    // Agrega estas líneas:
    $table->string('titulo', 100);
    $table->text('descripcion')->nullable();
    $table->boolean('completada')->default(false);
    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
    // Fin de las líneas nuevas
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streaks');
    }
};
