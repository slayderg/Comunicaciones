<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración (crea la tabla accions)
     */
    public function up(): void
    {
        Schema::create('accions', function (Blueprint $table) {
            $table->id();

            // Relación con estrategias
            $table->foreignId('estrategia_id')
                  ->constrained('estrategias')
                  ->cascadeOnDelete();

            // Campos principales
            $table->string('nombre'); // título o nombre de la acción
            $table->text('descripcion')->nullable();
            $table->string('responsable')->nullable(); // persona encargada

            // Fechas
            $table->date('fecha_planeada_inicio'); // fecha inicial planeada
            $table->date('fecha_planeada_fin')->nullable(); // fecha final planeada
            $table->date('fecha_real_inicio')->nullable(); // fecha real de inicio
            $table->date('fecha_real_fin')->nullable(); // fecha real de finalización

            // Estado y avance
            $table->enum('estado', ['pendiente','en_progreso','completada','cancelada'])
                  ->default('pendiente');
            $table->unsignedTinyInteger('porcentaje_avance')->default(0); // 0..100 %

            $table->timestamps();
        });
    }

    /**
     * Revierte la migración (elimina la tabla accions)
     */
    public function down(): void
    {
        Schema::dropIfExists('accions');
    }
};

