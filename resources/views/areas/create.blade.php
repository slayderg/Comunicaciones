@extends('layouts.app')
@section('title','Crear Área')

@section('content')
  <h1 class="text-orange">Crear Área</h1>

  @if ($errors->any())
    <div class="ug-card" style="border-left-color:#cc0000;margin-bottom:12px;">
      <strong>Corrige los siguientes campos:</strong>
      <ul style="margin:6px 0 0 18px;">
        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('areas.store') }}" method="POST" class="form-wrap">
    @csrf

    <div class="form-group">
      <label for="nombre">Nombre</label>
      <input id="nombre" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
    </div>

    <div class="form-group">
      <label for="descripcion">Descripción (opcional)</label>
      <textarea id="descripcion" name="descripcion" rows="5" class="form-control">{{ old('descripcion') }}</textarea>
    </div>

    <div class="form-actions">
      <button class="btn-primary">Guardar</button>
      <a class="btn-link" href="{{ route('areas.index') }}">Cancelar</a>
    </div>
  </form>
@endsection
