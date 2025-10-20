<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('noticias', function (Blueprint $table) {
        $table->id();
        $table->string('titulo');
        $table->string('slug')->unique();
        $table->string('resumen')->nullable();
        $table->text('contenido');
        $table->string('imagen')->nullable(); // guardaremos ruta dentro de storage
        $table->string('autor')->nullable();
        $table->boolean('publicado')->default(false);
        $table->timestamp('fecha_publicacion')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('noticias');
    }
};
