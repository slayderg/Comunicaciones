@extends('layouts.app')
@section('title',$accion->titulo)

@section('content')
<h1 class="ug-title">{{ $accion->titulo }}</h1>

<div class="ug-card">
  <p class="ug-muted">Estrategia: <strong>{{ $accion->estrategia?->titulo }}</strong></p>
  <p class="ug-muted">Responsable: <strong>{{ $accion->responsable }}</strong></p>
  <p class="ug-muted">Estado: <strong>{{ ucfirst(str_replace('_',' ',$accion->estado)) }}</strong></p>
  <p class="ug-muted">
    Planeada: {{ optional($accion->fecha_planeada)->format('d/m/Y') ?? '—' }}
    @if($accion->fecha_cumplimiento) — Real: {{ $accion->fecha_cumplimiento->format('d/m/Y') }} @endif
  </p>
  <p class="ug-muted">% Avance: <strong>{{ $accion->avance }}%</strong></p>
  <div style="margin-top:10px;white-space:pre-line">{{ $accion->descripcion }}</div>
</div>

<div style="margin-top:14px">
  <a href="{{ route('acciones.edit',$accion) }}" class="ug-link">Editar</a>
  <a href="{{ route('acciones.index') }}" class="ug-link" style="margin-left:10px">Volver</a>
</div>
@endsection
