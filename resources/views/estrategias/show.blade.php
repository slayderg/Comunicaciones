@extends('layouts.app')
@section('title',$estrategia->titulo)

@section('content')
  <h1 class="ug-title text-orange" style="margin-bottom:6px;">{{ $estrategia->titulo }}</h1>
  <p class="ug-muted" style="margin:0 0 18px 0;">
    Área: <strong>{{ optional($estrategia->area)->nombre }}</strong> ·
    Estado: <strong>{{ ucfirst(str_replace('_',' ',$estrategia->estado)) }}</strong><br>
    Fechas:
    {{ $estrategia->fecha_inicio ? \Carbon\Carbon::parse($estrategia->fecha_inicio)->format('d/m/Y') : '—' }}
    –
    {{ $estrategia->fecha_fin ? \Carbon\Carbon::parse($estrategia->fecha_fin)->format('d/m/Y') : '—' }}
  </p>

  @if($estrategia->descripcion)
    <div class="ug-card" style="border-left:none;">
      {!! nl2br(e($estrategia->descripcion)) !!}
    </div>
  @else
    <p class="ug-muted">Sin descripción.</p>
  @endif

  <div class="form-actions" style="margin-top:16px;">
    <a href="{{ route('estrategias.edit',$estrategia) }}" class="ug-btn">Editar</a>
    <a href="{{ route('estrategias.index') }}" class="btn-link">Volver</a>
  </div>
@endsection
