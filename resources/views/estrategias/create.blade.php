@extends('layouts.app')
@section('title','Nueva Estrategia')

@section('content')
  <h1 class="ug-title text-orange">Crear Estrategia</h1>

  @if ($errors->any())
    <div class="ug-card" style="border-left-color:#cc0000;margin-bottom:12px;">
      <strong>Corrige los siguientes campos:</strong>
      <ul style="margin:6px 0 0 18px;">
        @foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('estrategias.store') }}" method="POST" class="form-wrap">
    @csrf

    <div class="form-group">
      <label for="area_id">Área</label>
      <select id="area_id" name="area_id" class="form-control" required>
        <option value="">Seleccione…</option>
        @foreach($areas as $a)
          <option value="{{ $a->id }}" {{ old('area_id')==$a->id?'selected':'' }}>{{ $a->nombre }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="titulo">Título</label>
      <input id="titulo" name="titulo" class="form-control" value="{{ old('titulo') }}" required>
    </div>

    <div class="form-group">
      <label for="descripcion">Descripción</label>
      <textarea id="descripcion" name="descripcion" rows="6" class="form-control">{{ old('descripcion') }}</textarea>
    </div>

    <div class="form-group" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
      <div>
        <label for="fecha_inicio">Fecha inicio</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
      </div>
      <div>
        <label for="fecha_fin">Fecha fin</label>
        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}">
      </div>
    </div>

    <div class="form-group">
      <label for="estado">Estado</label>
      <select id="estado" name="estado" class="form-control" required>
        @php $estados=['planificada'=>'Planificada','en_proceso'=>'En proceso','completada'=>'Completada','cancelada'=>'Cancelada']; @endphp
        @foreach($estados as $k=>$v)
          <option value="{{ $k }}" {{ old('estado')==$k?'selected':'' }}>{{ $v }}</option>
        @endforeach
      </select>
    </div>

    <div class="form-actions">
      <button class="btn-primary">Guardar</button>
      <a href="{{ route('estrategias.index') }}" class="btn-link">Cancelar</a>
    </div>
  </form>
@endsection

