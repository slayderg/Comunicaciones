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
    Schema::create('estrategias', function (Blueprint $table) {
         $table->id();
        $table->foreignId('area_id')->constrained('areas')->cascadeOnDelete();
        $table->string('titulo');
        $table->text('descripcion')->nullable();
        $table->date('fecha_inicio')->nullable();
        $table->date('fecha_fin')->nullable();
        $table->enum('estado', ['planificada', 'en_proceso', 'completada', 'cancelada'])->default('planificada');
        $table->timestamps();
    });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estrategias');
    }
};
