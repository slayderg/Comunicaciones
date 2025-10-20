@extends('layouts.app')
@section('title','Áreas')

@section('content')
  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
    <h1 class="text-orange" style="margin:0;">Áreas</h1>
    <a href="{{ route('areas.create') }}" class="ug-btn">Crear área</a>
  </div>

  @if(session('success'))
    <div class="ug-card" style="margin:16px 0;border-left-color:#28a745;">{{ session('success') }}</div>
  @endif
  @if(session('error'))
    <div class="ug-card" style="margin:16px 0;border-left-color:#cc0000;">{{ session('error') }}</div>
  @endif

  @if($areas->isEmpty())
    <p class="ug-muted">No hay áreas registradas.</p>
  @else
    <div class="ug-grid" style="margin-top:16px;">
      @foreach($areas as $a)
        <article class="ug-card" style="border-left:none;">
          <h2 style="margin:0 0 6px 0">{{ $a->nombre }}</h2>
          <p class="ug-muted" style="margin:0 0 10px 0">{{ $a->descripcion ?: 'Sin descripción' }}</p>
          <p class="ug-muted" style="margin:0 0 12px 0">Estrategias: {{ $a->estrategias_count }}</p>

          <div style="display:flex;gap:12px;flex-wrap:wrap;">
            <a href="{{ route('areas.show',$a) }}" class="ug-link">Ver</a>
            <a href="{{ route('areas.edit',$a) }}" class="ug-link">Editar</a>
            <form action="{{ route('areas.destroy',$a) }}" method="POST" onsubmit="return confirm('¿Eliminar esta área?');">
              @csrf @method('DELETE')
              <button type="submit" class="ug-link" style="background:none;border:0;cursor:pointer;color:#cc0000;">Eliminar</button>
            </form>
          </div>
        </article>
      @endforeach
    </div>

    <div style="margin-top:18px;">
      {{ $areas->links() }}
    </div>
  @endif
@endsection
