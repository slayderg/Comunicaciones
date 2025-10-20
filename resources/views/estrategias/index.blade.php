@extends('layouts.app')
@section('title','Estrategias')

@section('content')
  <h1 class="ug-title text-orange">Estrategias</h1>

  @if(session('success'))
    <div class="ug-card" style="border-left-color:#007b5e;margin-bottom:16px;background:#e6f7f2;">
      <strong>{{ session('success') }}</strong>
    </div>
  @endif

  <div style="margin-bottom:16px;">
    <a href="{{ route('estrategias.create') }}" class="ug-btn">Nueva estrategia</a>
  </div>

  @if($estrategias->isEmpty())
    <p class="ug-muted">No hay estrategias registradas.</p>
  @else
    <div class="ug-grid">
      @foreach($estrategias as $e)
        <article class="ug-card" style="border-left:none;">
          <h3 style="margin:0 0 6px 0">{{ $e->titulo }}</h3>
          <p class="ug-muted" style="margin:0 0 8px 0;">
            Área: <strong>{{ optional($e->area)->nombre }}</strong> ·
            Estado:
            <span style="font-weight:600">
              {{ ucfirst(str_replace('_',' ',$e->estado)) }}
            </span>
            @if($e->fecha_inicio || $e->fecha_fin)
              <br>Fechas:
              {{ $e->fecha_inicio ? \Carbon\Carbon::parse($e->fecha_inicio)->format('d/m/Y') : '—' }}
              –
              {{ $e->fecha_fin ? \Carbon\Carbon::parse($e->fecha_fin)->format('d/m/Y') : '—' }}
            @endif
          </p>

          @if($e->descripcion)
            <p style="margin:8px 0 12px 0">{{ Str::limit($e->descripcion, 160) }}</p>
          @endif

          <div style="display:flex;gap:12px;align-items:center;">
            <a class="ug-link" href="{{ route('estrategias.show',$e) }}">Ver</a>
            <a class="ug-link" href="{{ route('estrategias.edit',$e) }}">Editar</a>

            <form action="{{ route('estrategias.destroy',$e) }}" method="POST" onsubmit="return confirm('¿Eliminar esta estrategia?')" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" style="background:none;border:none;color:#cc0000;font-weight:600;cursor:pointer;">
                Eliminar
              </button>
            </form>
          </div>
        </article>
      @endforeach
    </div>

    <div style="margin-top:18px;">
      {{ $estrategias->links() }}
    </div>
  @endif
@endsection
