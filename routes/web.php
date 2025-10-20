<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\EstrategiaController;
use App\Http\Controllers\AccionController;
use App\Http\Controllers\EvidenciaController;
use App\Http\Controllers\SeguimientoController;


// Cuando entras a la raíz, redirige al listado de noticias
Route::get('/', function () {
    return redirect()->route('noticias.index');
});

// Rutas del CRUD de Noticias
Route::resource('noticias', NoticiaController::class);

// Rutas del CRUD de Áreas
Route::resource('areas', AreaController::class);

// Rutas del CRUD de Estrategias
Route::resource('estrategias', EstrategiaController::class);

// Rutas del CRUD de Acciones
Route::resource('acciones', AccionController::class);

// Rutas para Evidencias asociadas a acciones
Route::post('acciones/{accion}/evidencias', [EvidenciaController::class, 'store'])->name('evidencias.store');

// Rutas para Seguimientos asociados a acciones
Route::post('acciones/{accion}/seguimientos', [SeguimientoController::class, 'store'])->name('seguimientos.store');
