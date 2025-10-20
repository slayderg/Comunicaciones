@extends('layouts.app')

@section('title', 'Evidencias de ' . $accion->nombre)

@section('content')
<h2>Evidencias para: {{ $accion->nombre }}</h2>

<ul>
@foreach ($accion->evidencias as $evidencia)
    <li>
        <strong>{{ $evidencia->tipo }}:</strong>
        <a href="{{ Storage::url($evidencia->archivo) }}" target="_blank">Ver archivo</a>
    </li>
@endforeach
</ul>

<h4>Agregar nueva evidencia</h4>
<form action="{{ route('evidencias.store', $accion) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="tipo" placeholder="Tipo de evidencia" required>
    <input type="file" name="archivo" required>
    <button type="submit">Subir evidencia</button>
</form>
@endsection
