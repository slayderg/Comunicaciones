<?php

namespace App\Http\Controllers;

use App\Models\Estrategia;
use App\Models\Area;
use Illuminate\Http\Request;

class EstrategiaController extends Controller
{
    /** Listado de estrategias */
    public function index()
    {
        $estrategias = Estrategia::with('area')->orderBy('created_at', 'desc')->paginate(10);
        return view('estrategias.index', compact('estrategias'));
    }

    /** Formulario para crear */
    public function create()
    {
        $areas = Area::all();
        return view('estrategias.create', compact('areas'));
    }

    /** Guardar nueva estrategia */
    public function store(Request $request)
    {
        $data = $request->validate([
            'area_id'        => 'required|exists:areas,id',
            'titulo'         => 'required|string|max:255',
            'descripcion'    => 'nullable|string',
            'fecha_inicio'   => 'nullable|date',
            'fecha_fin'      => 'nullable|date|after_or_equal:fecha_inicio',
            'estado'         => 'required|in:planificada,en_proceso,completada,cancelada',
        ]);

        Estrategia::create($data);
        return redirect()->route('estrategias.index')->with('success', 'Estrategia creada correctamente.');
    }

    /** Ver detalle */
    public function show(Estrategia $estrategia)
    {
        return view('estrategias.show', compact('estrategia'));
    }

    /** Formulario editar */
    public function edit(Estrategia $estrategia)
    {
        $areas = Area::all();
        return view('estrategias.edit', compact('estrategia', 'areas'));
    }

    /** Actualizar */
    public function update(Request $request, Estrategia $estrategia)
    {
        $data = $request->validate([
            'area_id'        => 'required|exists:areas,id',
            'titulo'         => 'required|string|max:255',
            'descripcion'    => 'nullable|string',
            'fecha_inicio'   => 'nullable|date',
            'fecha_fin'      => 'nullable|date|after_or_equal:fecha_inicio',
            'estado'         => 'required|in:planificada,en_proceso,completada,cancelada',
        ]);

        $estrategia->update($data);
        return redirect()->route('estrategias.index')->with('success', 'Estrategia actualizada correctamente.');
    }

    /** Eliminar */
    public function destroy(Estrategia $estrategia)
    {
        $estrategia->delete();
        return redirect()->route('estrategias.index')->with('success', 'Estrategia eliminada correctamente.');
    }
}
