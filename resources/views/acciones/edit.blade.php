@extends('layouts.app')
@section('title','Editar Acción')

@section('content')
<h1 class="ug-title">Editar Acción</h1>

@if ($errors->any())
  <div class="ug-card" style="border-left-color:#cc0000;margin-bottom:12px">
    <strong>Corrige los siguientes campos:</strong>
    <ul>@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
  </div>
@endif

<form action="{{ route('acciones.update',$accion) }}" method="POST" class="form-wrap">
  @csrf @method('PUT')
  @include('acciones.partials.form', ['btn' => 'Guardar cambios'])
</form>
@endsection
