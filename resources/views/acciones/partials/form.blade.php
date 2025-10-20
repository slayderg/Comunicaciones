@php
  $estSel = old('estrategia_id', $accion->estrategia_id ?? ($preselect ?? ''));
@endphp

<div class="form-group">
  <label>Estrategia</label>
  <select name="estrategia_id" class="form-control" required>
    <option value="">Selecciona una estrategia</option>
    @foreach($estrategias as $e)
      <option value="{{ $e->id }}" @selected($estSel==$e->id)>{{ $e->titulo }}</option>
    @endforeach
  </select>
</div>

<div class="form-group">
  <label>Título</label>
  <input name="titulo" class="form-control" value="{{ old('titulo', $accion->titulo ?? '') }}" required>
</div>

<div class="form-group">
  <label>Descripción</label>
  <textarea name="descripcion" rows="4" class="form-control">{{ old('descripcion', $accion->descripcion ?? '') }}</textarea>
</div>

<div class="form-group" style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
  <div>
    <label>Responsable</label>
    <input name="responsable" class="form-control" value="{{ old('responsable', $accion->responsable ?? '') }}" required>
  </div>
  <div>
    <label>Estado</label>
    <select name="estado" class="form-control" required>
      @foreach(['pendiente'=>'Pendiente','en_progreso'=>'En progreso','finalizada'=>'Finalizada','cancelada'=>'Cancelada'] as $k=>$v)
        <option value="{{ $k }}" @selected(old('estado', $accion->estado ?? 'pendiente')==$k)>{{ $v }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="form-group" style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px">
  <div>
    <label>Fecha planeada</label>
    <input type="date" name="fecha_planeada" class="form-control"
           value="{{ old('fecha_planeada', optional($accion->fecha_planeada ?? null)->format('Y-m-d')) }}" required>
  </div>
  <div>
    <label>Fecha cumplimiento (real)</label>
    <input type="date" name="fecha_cumplimiento" class="form-control"
           value="{{ old('fecha_cumplimiento', optional($accion->fecha_cumplimiento ?? null)->format('Y-m-d')) }}">
  </div>
  <div>
    <label>% Avance</label>
    <input type="number" name="avance" min="0" max="100" class="form-control"
           value="{{ old('avance', $accion->avance ?? 0) }}" required>
  </div>
</div>

<div class="form-actions">
  <button class="btn-primary">{{ $btn }}</button>
  <a href="{{ route('acciones.index') }}" class="btn-link">Cancelar</a>
</div>
