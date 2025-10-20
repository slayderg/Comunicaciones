@extends('layouts.app')
@section('title','Editar Noticia')

@section('content')
<h1 class="ug-title" style="color: var(--ug-orange)">Editar Noticia</h1>

@if ($errors->any())
  <div class="ug-card" style="border-left-color:#cc0000;margin-bottom:12px;">
    <strong>Corrige los siguientes campos:</strong>
    <ul style="margin:6px 0 0 18px;">
      @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif

<form action="{{ route('noticias.update', $noticia) }}" method="POST" enctype="multipart/form-data" class="form-wrap">
  @csrf
  @method('PUT')

  <div class="form-group">
    <label for="titulo">Título</label>
    <input id="titulo" name="titulo" class="form-control" value="{{ old('titulo', $noticia->titulo) }}" required>
  </div>

  <div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea id="contenido" name="contenido" rows="8" class="form-control" required>{{ old('contenido', $noticia->contenido) }}</textarea>
  </div>

  <div class="form-group">
    <label for="autor">Autor</label>
    <input id="autor" name="autor" class="form-control" value="{{ old('autor', $noticia->autor) }}" required>
  </div>

  <div class="form-group">
    <label for="fecha_publicacion">Fecha de publicación (opcional)</label>
    <input id="fecha_publicacion" type="date" name="fecha_publicacion" class="form-control"
           value="{{ old('fecha_publicacion', optional($noticia->fecha_publicacion)->format('Y-m-d')) }}">
  </div>

  <div class="form-group">
    <label>Imagen actual</label>
    @if($noticia->imagen)
      <div style="margin-bottom:8px">
        <img src="{{ asset('storage/'.$noticia->imagen) }}" alt="{{ $noticia->titulo }}"
             style="max-height:140px;border-radius:8px;display:block">
      </div>
    @else
      <p class="ug-muted">Sin imagen.</p>
    @endif
    <label for="imagen">Reemplazar imagen (opcional)</label>
    <input id="imagen" type="file" name="imagen" class="form-control">
  </div>

  <div class="form-group">
    <label>
      <input type="checkbox" name="publicado" {{ old('publicado', $noticia->publicado) ? 'checked' : '' }}>
      Publicado
    </label>
  </div>

  <div class="form-actions">
    <button type="submit" class="btn-primary">Guardar cambios</button>
    <a href="{{ route('noticias.index') }}" class="btn-link">Cancelar</a>
  </div>
</form>
@endsection


