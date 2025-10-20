@extends('layouts.app')
@section('title','Crear Acción')

@section('content')
<h1 class="ug-title">Crear Acción</h1>

@if ($errors->any())
  <div class="ug-card" style="border-left-color:#cc0000;margin-bottom:12px">
    <strong>Corrige los siguientes campos:</strong>
    <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<form action="{{ route('acciones.store') }}" method="POST" class="form-wrap">
  @csrf
  @include('acciones.partials.form', ['btn' => 'Guardar', 'preselect' => $preselect ?? null])
</form>
@endsection
