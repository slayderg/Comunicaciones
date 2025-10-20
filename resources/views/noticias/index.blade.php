@extends('layouts.app')
@section('title','Noticias')

@section('content')
  

  <div style="display:flex;justify-content:space-between;align-items:center;gap:12px;">
    <h1 class="text-orange" style="margin:0;">Noticias</h1>
    <a href="{{ route('noticias.create') }}" class="ug-btn">Crear Noticia</a>
  </div>

  {{-- Mensaje de éxito --}}
  @if(session('success'))
    <div class="ug-card" style="border-left-color:#007b5e;margin-bottom:16px;background:#e6f7f2;">
      <strong>{{ session('success') }}</strong>
    </div>
  @endif

  @if($noticias->isEmpty())
    <p class="ug-muted">No hay noticias aún.</p>
  @else
    <div class="ug-grid">
      @foreach($noticias as $n)
        <article class="ug-card" style="padding:0;border-left:none;overflow:hidden;">
          {{-- Imagen --}}
          @if($n->imagen)
            <a href="{{ route('noticias.show',$n) }}" style="display:block;">
              <img
                src="{{ asset('storage/'.$n->imagen) }}"
                alt="{{ $n->titulo }}"
                style="width:100%;height:180px;object-fit:cover;display:block;">
            </a>
          @endif

          <div style="padding:16px;">
            <a href="{{ route('noticias.show',$n) }}" class="ug-link" style="text-decoration:none;">
              <h2 style="margin:0 0 8px 0;color:#111;line-height:1.25;">{{ $n->titulo }}</h2>
            </a>

            <div class="ug-muted" style="font-size:14px;margin-bottom:8px;">
              {{ ($n->fecha_publicacion ? \Carbon\Carbon::parse($n->fecha_publicacion) : $n->created_at)->format('d F, Y') }}
              @if($n->autor) · {{ $n->autor }} @endif
            </div>

            <div style="display:flex;gap:10px;align-items:center;">
              <a href="{{ route('noticias.show',$n) }}" class="ug-link">Leer más →</a>
              <a href="{{ route('noticias.edit',$n) }}" class="ug-link">Editar</a>

              {{-- Botón eliminar --}}
              <form action="{{ route('noticias.destroy', $n->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit"
                          style="background:none;border:none;color:#cc0000;cursor:pointer;font-weight:600;"
                          onclick="return confirm('¿Seguro que deseas eliminar esta noticia?')">
                      Eliminar
                  </button>
              </form>
            </div>
          </div>
        </article>
      @endforeach
    </div>

    <div style="margin-top:18px;">
      {{ $noticias->links() }}
    </div>
  @endif
@endsection

