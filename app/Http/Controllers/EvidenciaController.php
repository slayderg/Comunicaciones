<?php

namespace App\Http\Controllers;

use App\Models\Evidencia;
use App\Models\Accion;
use Illuminate\Http\Request;

class EvidenciaController extends Controller
{
    public function store(Request $request, Accion $accion)
    {
        $request->validate([
            'tipo' => 'required|string',
            'archivo' => 'required|file|mimes:jpg,jpeg,png,pdf,mp4|max:2048',
        ]);

        // Subir el archivo y guardar la ruta
        $path = $request->file('archivo')->store('evidencias', 'public');

        // Crear la evidencia asociada a la acción
        $evidencia = new Evidencia();
        $evidencia->accion_id = $accion->id;
        $evidencia->tipo = $request->tipo;
        $evidencia->archivo = $path;
        $evidencia->save();

        return redirect()->route('acciones.show', $accion)->with('success', 'Evidencia cargada con éxito.');
    }
}
