@extends('layouts.app')
@section('title', $area->nombre)

@section('content')
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
    <h1 class="text-orange" style="margin:0;">{{ $area->nombre }}</h1>
    <a href="{{ route('areas.edit',$area) }}" class="ug-btn">Editar</a>
  </div>

  <p class="ug-muted" style="margin:8px 0 20px 0;">{{ $area->descripcion ?: 'Sin descripción' }}</p>

  <h3 style="margin:0 0 12px 0;">Estrategias de esta área</h3>
  @if($area->estrategias->isEmpty())
    <p class="ug-muted">Aún no hay estrategias en esta área.</p>
  @else
    <div class="ug-grid">
      @foreach($area->estrategias as $e)
        <article class="ug-card" style="border-left:none;">
          <h4 style="margin:0 0 8px 0;">{{ $e->titulo }}</h4>
          <p class="ug-muted" style="margin:0 0 10px 0;">{{ Str::limit($e->descripcion,120) }}</p>
          <a href="{{ route('estrategias.show',$e) }}" class="ug-link">Ver estrategia</a>
        </article>
      @endforeach
    </div>
  @endif

  <div style="margin-top:18px;">
    <a href="{{ route('areas.index') }}" class="btn-link">← Volver al listado</a>
  </div>
@endsection
