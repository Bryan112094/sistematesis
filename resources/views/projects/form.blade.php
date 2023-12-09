<div class="row mb-3">
    <label for="estado" class="col-md-4 col-form-label text-md-end">Estado</label>
    <div class="col-md-6">
    @if (!empty($project->estado))
        <select id="estado" name="estado" class="form-select form-select-sm @error('estado') is-invalid @enderror">
        @foreach($estados['titulo'] as &$estado)
            <option value="{{ $estado }}" @if($estado==$project->estado) Selected @endif>{{ $estado }}</option>
        @endforeach
        </select>
        @error('estado')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    @else
        <input type="text" name="estado" id="estado" value="Nuevo"class="form-control form-control-sm @error('estado') is-invalid @enderror" readonly>
    @endif
    </div>
</div>
<div class="row mb-3">
    <label for="codigo" class="col-md-4 col-form-label text-md-end">Código</label>
    <div class="col-md-6">
        @if (isset($new_cod))
            <input type="text" id="codigo" name="codigo" readonly class="form-control form-control-sm @error('codigo') is-invalid @enderror" value="{{ old('codigo', $new_cod) }}">
        @else
            <input type="text" id="codigo" name="codigo" readonly class="form-control form-control-sm @error('codigo') is-invalid @enderror" value="{{ old('codigo', $project->codigo) }}">
        @endif
        @error('codigo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@if(Auth::user()->cargo == 'JP')
    <input type="hidden" name="jefe_proyecto_id" id="jefe_proyecto_id" value="{{ Auth::user()->id }}">
@else
<div class="row mb-3">
    <label for="jefe_proyecto_id" class="col-md-4 col-form-label text-md-end">Jefe Proyecto</label>
    <div class="col-md-6">
        <select id="jefe_proyecto_id" name="jefe_proyecto_id" class="form-select form-select-sm @error('jefe_proyecto_id') is-invalid @enderror">
        @foreach($jefes as $jefe)
            <option value="{{ $jefe->id }}">{{ $jefe->name }}</option>
        @endforeach
        </select>
        @error('jefe_proyecto_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
@endif
<div class="row mb-3">
    <label for="jefe_calidad_id" class="col-md-4 col-form-label text-md-end">Jefe Calidad</label>
    <div class="col-md-6">
        <select id="jefe_calidad_id" name="jefe_calidad_id" class="form-select form-select-sm @error('jefe_proyecto_id') is-invalid @enderror">
        @foreach($jefesc as $jefec)
            <option value="{{ $jefec->id }}">{{ $jefec->name }}</option>
        @endforeach
        </select>
        @error('jefe_calidad_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $project->nombre) }}" autocomplete="nombre" autofocus>
        @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripción</label>
    <div class="col-md-6">
        <textarea name="descripcion" id="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror" rows="5">{{ old('descripcion', $project->descripcion) }}</textarea>
        @error('descripcion')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>