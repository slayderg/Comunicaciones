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
        Schema::create('evidencias', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('accion_id'); // Relacionado con la tabla Accion
        $table->string('tipo'); // Tipo de evidencia (foto, video, enlace)
        $table->string('archivo'); // Ruta del archivo o enlace
        $table->timestamps();

        $table->foreign('accion_id')->references('id')->on('accions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidencias');
    }
};
