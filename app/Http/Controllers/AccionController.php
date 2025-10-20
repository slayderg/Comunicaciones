<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use App\Models\Estrategia;
use Illuminate\Http\Request;

class AccionController extends Controller
{
    public function index(Request $request)
    {
        $estrategias = Estrategia::with('area')->orderBy('titulo')->get();

        $acciones = Accion::with(['estrategia.area'])
            ->when($request->filled('estrategia_id'), fn($q) => $q->where('estrategia_id', $request->estrategia_id))
            ->when($request->filled('estado'),        fn($q) => $q->where('estado', $request->estado))
            ->when($request->filled('q'),             fn($q) => $q->where(function ($qq) use ($request) {
                $qq->where('nombre','like','%'.$request->q.'%')       // ← antes 'titulo'
                   ->orWhere('responsable','like','%'.$request->q.'%');
            }))
            ->orderBy('fecha_planeada_inicio','asc')                    // ← antes 'fecha_planeada'
            ->paginate(12)
            ->withQueryString();

        return view('acciones.index', compact('acciones','estrategias'));
    }

    public function create(Request $request)
    {
        $estrategias = Estrategia::orderBy('titulo')->get();
        $preselect   = $request->get('estrategia_id');
        return view('acciones.create', compact('estrategias','preselect'));
    }

    public function store(Request $request)
    {
        // Validamos con los nombres que usas en el formulario
        $request->validate([
            'estrategia_id'      => 'required|exists:estrategias,id',
            'titulo'             => 'required|string|max:255',
            'descripcion'        => 'nullable|string',
            'responsable'        => 'nullable|string|max:255',
            'estado'             => 'required|in:pendiente,en_progreso,completada,cancelada',
            'fecha_planeada'     => 'required|date',
            'fecha_cumplimiento' => 'nullable|date|after_or_equal:fecha_planeada',
            'avance'             => 'required|integer|min:0|max:100',
        ]);

        // Mapeamos a los nombres REALES de la tabla `accions`
        $data = [
            'estrategia_id'         => $request->estrategia_id,
            'nombre'                => $request->titulo,
            'descripcion'           => $request->descripcion,
            'responsable'           => $request->responsable,
            'estado'                => $request->estado,
            'fecha_planeada_inicio' => $request->fecha_planeada,
            'fecha_planeada_fin'    => $request->fecha_cumplimiento,
            'porcentaje_avance'     => $request->avance,
        ];

        Accion::create($data);

        return redirect()->route('acciones.index')->with('success','Acción creada.');
    }

    public function show(Accion $accion)
    {
        $accion->load('estrategia.area');
        return view('acciones.show', compact('accion'));
    }

    public function edit(Accion $accion)
    {
        $estrategias = Estrategia::orderBy('titulo')->get();
        return view('acciones.edit', compact('accion','estrategias'));
    }

    public function update(Request $request, Accion $accion)
    {
        // Validamos con los nombres de tu formulario
        $request->validate([
            'estrategia_id'      => 'required|exists:estrategias,id',
            'titulo'             => 'required|string|max:255',
            'descripcion'        => 'nullable|string',
            'responsable'        => 'nullable|string|max:255',
            'estado'             => 'required|in:pendiente,en_progreso,completada,cancelada',
            'fecha_planeada'     => 'required|date',
            'fecha_cumplimiento' => 'nullable|date|after_or_equal:fecha_planeada',
            'avance'             => 'required|integer|min:0|max:100',
        ]);

        // Mapeo a la BD
        $data = [
            'estrategia_id'         => $request->estrategia_id,
            'nombre'                => $request->titulo,
            'descripcion'           => $request->descripcion,
            'responsable'           => $request->responsable,
            'estado'                => $request->estado,
            'fecha_planeada_inicio' => $request->fecha_planeada,
            'fecha_planeada_fin'    => $request->fecha_cumplimiento,
            'porcentaje_avance'     => $request->avance,
        ];

        $accion->update($data);

        return redirect()->route('acciones.index')->with('success','Acción actualizada.');
    }

    public function destroy(Accion $accion)
    {
        $accion->delete();
        return redirect()->route('acciones.index')->with('success','Acción eliminada.');
    }
}
