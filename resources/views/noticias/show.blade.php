@extends('layouts.app')

@section('title', $noticia->titulo)

@section('content')
  <article class="ug-card" style="padding:22px;">
    
    {{-- Imagen principal --}}
    @if ($noticia->imagen)
      <img src="{{ asset('storage/'.$noticia->imagen) }}" 
           alt="{{ $noticia->titulo }}" 
           style="width:100%;max-height:420px;object-fit:cover;border-radius:12px;margin-bottom:18px;">
    @endif

    {{-- Título --}}
    <h1 class="ug-title" style="margin-bottom:10px;">{{ $noticia->titulo }}</h1>

    {{-- Datos de autor y fecha --}}
    <p class="ug-muted" style="margin-bottom:20px;">
      Por <strong>{{ $noticia->autor }}</strong> |
      Publicada el 
      <span>{{ $noticia->fecha_publicacion ? \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y') : $noticia->created_at->format('d/m/Y') }}</span>
    </p>

    {{-- Contenido --}}
    <div style="line-height:1.6;font-size:17px;color:#333;">
      {!! nl2br(e($noticia->contenido)) !!}
    </div>

    {{-- Botón volver --}}
    <div style="margin-top:28px;">
      <a href="{{ route('noticias.index') }}" class="btn-primary" style="text-decoration:none;">← Volver a noticias</a>
    </div>

  </article>
@endsection
