<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::withCount('estrategias')->orderBy('nombre')->paginate(12);
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required','string','max:255','unique:areas,nombre'],
            'descripcion' => ['nullable','string'],
        ]);

        Area::create($data);
        return redirect()->route('areas.index')->with('success','Área creada correctamente.');
    }

    public function show(Area $area)
    {
        $area->load('estrategias');
        return view('areas.show', compact('area'));
    }

    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $data = $request->validate([
            'nombre' => [
                'required','string','max:255',
                Rule::unique('areas','nombre')->ignore($area->id),
            ],
            'descripcion' => ['nullable','string'],
        ]);

        $area->update($data);
        return redirect()->route('areas.index')->with('success','Área actualizada correctamente.');
    }

    public function destroy(Area $area)
    {
        // si deseas impedir eliminar con estrategias relacionadas, descomenta:
        // if ($area->estrategias()->exists()) {
        //     return back()->with('error','No puedes eliminar un área con estrategias.');
        // }

        $area->delete();
        return redirect()->route('areas.index')->with('success','Área eliminada correctamente.');
    }
}
