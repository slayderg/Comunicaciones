@extends('layouts.app')
@section('title','Crear Noticia')

@section('content')
<h1 class="text-orange">Crear Nueva Noticia</h1>

@if ($errors->any())
  <div class="ug-card" style="border-left-color:#cc0000;margin-bottom:12px;">
    <strong>Corrige los siguientes campos:</strong>
    <ul style="margin:6px 0 0 18px;">
      @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
  </div>
@endif

<form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data" class="form-wrap">
  @csrf

  <div class="form-group">
    <label for="titulo">Título</label>
    <input id="titulo" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
  </div>

  <div class="form-group">
    <label for="contenido">Contenido</label>
    <textarea id="contenido" name="contenido" rows="8" class="form-control" required>{{ old('contenido') }}</textarea>
  </div>

  <div class="form-group">
    <label for="autor">Autor</label>
    <input id="autor" name="autor" class="form-control" value="{{ old('autor') }}" required>
  </div>

  <div class="form-group">
    <label for="fecha_publicacion">Fecha de publicación (opcional)</label>
    <input id="fecha_publicacion" type="date" name="fecha_publicacion" class="form-control"
           value="{{ old('fecha_publicacion') }}">
  </div>

  <div class="form-group">
    <label for="imagen">Imagen (requerida)</label>
    <input id="imagen" type="file" name="imagen" class="form-control" required>
  </div>

  <div class="form-group">
    <label><input type="checkbox" name="publicado" {{ old('publicado') ? 'checked' : '' }}> Publicado</label>
  </div>

  <div class="form-actions">
    <button class="btn-primary">Guardar</button>
    <a href="{{ route('noticias.index') }}" class="btn-link">Cancelar</a>
  </div>
</form>
@endsection
