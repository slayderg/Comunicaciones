@extends('layouts.app')

@section('title', 'Seguimientos de ' . $accion->nombre)

@section('content')
<h2>Seguimientos para: {{ $accion->nombre }}</h2>

<table class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>% Avance</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($accion->seguimientos as $seguimiento)
        <tr>
            <td>{{ $seguimiento->fecha_seguimiento->format('d-m-Y') }}</td>
            <td>{{ $seguimiento->descripcion_avance }}</td>
            <td>{{ $seguimiento->porcentaje_avance }}%</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h4>Agregar nuevo seguimiento</h4>
<form action="{{ route('seguimientos.store', $accion) }}" method="POST">
    @csrf
    <input type="date" name="fecha_seguimiento" required>
    <textarea name="descripcion_avance" placeholder="Descripción" required></textarea>
    <input type="number" name="porcentaje_avance" min="0" max="100" placeholder="% Avance" required>
    <button type="submit">Registrar seguimiento</button>
</form>
@endsection
