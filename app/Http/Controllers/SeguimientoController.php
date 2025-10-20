<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use App\Models\Seguimiento;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    public function store(Request $request, Accion $accion)
    {
        $request->validate([
            'descripcion_avance' => 'required|string',
            'porcentaje_avance' => 'required|integer|min:0|max:100',
            'fecha_seguimiento' => 'required|date',
        ]);

        // Crear el seguimiento
        $seguimiento = new Seguimiento();
        $seguimiento->accion_id = $accion->id;
        $seguimiento->descripcion_avance = $request->descripcion_avance;
        $seguimiento->porcentaje_avance = $request->porcentaje_avance;
        $seguimiento->fecha_seguimiento = $request->fecha_seguimiento;
        $seguimiento->save();

        return redirect()->route('acciones.show', $accion)->with('success', 'Seguimiento registrado con éxito.');
    }
}

