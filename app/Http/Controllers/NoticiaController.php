<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    /** Lista */
    public function index()
    {
        $noticias = Noticia::orderBy('created_at', 'desc')->paginate(10);
        return view('noticias.index', compact('noticias'));
    }

    /** Form crear */
    public function create()
    {
        return view('noticias.create');
    }

    /** Guardar */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'            => 'required|string|max:255',
            'contenido'         => 'required|string',
            'imagen'            => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
            'autor'             => 'required|string|max:255',
            'publicado'         => 'sometimes|boolean',
            'fecha_publicacion' => 'nullable|date',
        ]);

        $data['slug'] = Str::slug($data['titulo']).'-'.time();
        $data['publicado'] = $request->has('publicado');

        // guardar imagen en storage/app/public/noticias
        $file = $request->file('imagen');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->storeAs('noticias', $filename, 'public');
        $data['imagen'] = 'noticias/'.$filename;

        Noticia::create($data);

        return redirect()->route('noticias.index')->with('success', 'Noticia creada correctamente.');
    }

    /** Ver */
    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }

    /** Form editar */
    public function edit(Noticia $noticia)
    {
        return view('noticias.edit', compact('noticia'));
    }

    /** Actualizar */
    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->validate([
            'titulo'            => 'required|string|max:255',
            'contenido'         => 'required|string',
            'imagen'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'autor'             => 'required|string|max:255',
            'publicado'         => 'sometimes|boolean',
            'fecha_publicacion' => 'nullable|date',
        ]);

        if ($noticia->titulo !== $data['titulo']) {
            $data['slug'] = Str::slug($data['titulo']).'-'.time();
        }
        $data['publicado'] = $request->has('publicado');

        if ($request->hasFile('imagen')) {
            // borrar anterior si existe
            if ($noticia->imagen && Storage::disk('public')->exists($noticia->imagen)) {
                Storage::disk('public')->delete($noticia->imagen);
            }
            $file = $request->file('imagen');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('noticias', $filename, 'public');
            $data['imagen'] = 'noticias/'.$filename;
        }

        $noticia->update($data);

        return redirect()->route('noticias.index')->with('success', 'Noticia actualizada correctamente.');
    }

    /** Eliminar */
    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen && Storage::disk('public')->exists($noticia->imagen)) {
            Storage::disk('public')->delete($noticia->imagen);
        }
        $noticia->delete();

        return redirect()->route('noticias.index')->with('success', 'La noticia fue eliminada correctamente.');
    }
}
