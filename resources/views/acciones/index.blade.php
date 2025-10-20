@extends('layouts.app')
@section('title','Acciones')

@section('content')
<h1 class="ug-title">Acciones</h1>

<form method="GET" class="form-wrap" style="display:grid;gap:10px;grid-template-columns:1fr 1fr 1fr auto">
  <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Buscar por título o responsable">
  <select name="estrategia_id" class="form-control">
    <option value="">Todas las estrategias</option>
    @foreach($estrategias as $e)
      <option value="{{ $e->id }}" @selected(request('estrategia_id')==$e->id)>
        {{ $e->titulo }} @if($e->area) — {{ $e->area->nombre }} @endif
      </option>
    @endforeach
  </select>
  <select name="estado" class="form-control">
    <option value="">Todos los estados</option>
    @foreach(['pendiente'=>'Pendiente','en_progreso'=>'En progreso','finalizada'=>'Finalizada','cancelada'=>'Cancelada'] as $k=>$v)
      <option value="{{ $k }}" @selected(request('estado')==$k)>{{ $v }}</option>
    @endforeach
  </select>
  <button class="btn-primary">Filtrar</button>
</form>

<div class="ug-grid">
@forelse($acciones as $a)
  <article class="ug-card">
    <h3 style="margin:0 0 6px">{{ $a->titulo }}</h3>
    <div class="ug-muted" style="margin-bottom:6px">
      Estrategia: <strong>{{ $a->estrategia?->titulo }}</strong>
      @if($a->estrategia?->area) · Área: <strong>{{ $a->estrategia->area->nombre }}</strong> @endif
    </div>
    <div class="ug-muted" style="font-size:14px;margin-bottom:6px">
      Estado: <strong>{{ ucfirst(str_replace('_',' ',$a->estado)) }}</strong>
      · Planeada: {{ optional($a->fecha_planeada)->format('d/m/Y') ?? '—' }}
      · Real: {{ optional($a->fecha_cumplimiento)->format('d/m/Y') ?? '—' }}
      · Avance: <strong>{{ $a->avance }}%</strong>
    </div>
    <div>
      <a href="{{ route('acciones.show',$a) }}" class="ug-link">Ver</a>
      <a href="{{ route('acciones.edit',$a) }}" class="ug-link" style="margin-left:10px">Editar</a>
      <form action="{{ route('acciones.destroy',$a) }}" method="POST" style="display:inline"
            onsubmit="return confirm('¿Eliminar acción?');">
        @csrf @method('DELETE')
        <button class="ug-link" style="border:0;background:none;cursor:pointer;margin-left:10px">Eliminar</button>
      </form>
    </div>
  </article>
@empty
  <p class="ug-muted">No hay acciones.</p>
@endforelse
</div>

<div style="margin-top:18px">{{ $acciones->links() }}</div>
@endsection
