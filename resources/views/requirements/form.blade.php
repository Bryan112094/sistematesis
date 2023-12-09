<div class="row mb-3">
    <label for="estado" class="col-md-4 col-form-label text-md-end">Estado</label>
    <div class="col-md-6">
    @if (!empty($requirement->estado))
        <select id="estado" name="estado" class="form-select form-select-sm @error('estado') is-invalid @enderror">
        @foreach($estados['titulo'] as &$estado)
            <option value="{{ $estado }}" @if($estado==$requirement->estado) Selected @endif>{{ $estado }}</option>
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
            <input type="text" id="codigo" name="codigo" readonly class="form-control form-control-sm @error('codigo') is-invalid @enderror" value="{{ old('codigo', $requirement->codigo) }}">
        @endif
        @error('codigo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="analista_calidad" class="col-md-4 col-form-label text-md-end">Analistas Calidad</label>
    <div class="col-md-6">
        <select id="analista_calidad" name="analista_calidad[]" class="form-select form-select-sm" multiple>
            @foreach($a_calidads as $analista)
                <option value="{{ $analista->id }}" @if(in_array($analista->id, $analistas)) Selected @endif>{{ $analista->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-3">
    <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $requirement->nombre) }}" autocomplete="nombre" autofocus>
        @error('nombre')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="fecha_tentativa" class="col-md-4 col-form-label text-md-end">Fecha Tentativa</label>
    <div class="col-md-6">
        <input id="fecha_tentativa" type="date" class="form-control form-control-sm @error('fecha_tentativa') is-invalid @enderror" name="fecha_tentativa" @if(!empty($requirement->fecha_tentativa)) value="{{ old('fecha_tentativa', date('Y-m-d', strtotime($requirement->fecha_tentativa))) }}" @else value="{{ old('fecha_tentativa') }}" @endif autocomplete="fecha_tentativa">
        @error('fecha_tentativa')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <label for="fecha_real" class="col-md-4 col-form-label text-md-end">Fecha Real</label>
    <div class="col-md-6">
        <input id="fecha_real" type="date" class="form-control form-control-sm @error('fecha_real') is-invalid @enderror" name="fecha_real" @if(!empty($requirement->fecha_real)) value="{{ old('fecha_real', date('Y-m-d', strtotime($requirement->fecha_real))) }}" @else value="{{ old('fecha_real') }}" @endif autocomplete="fecha_real">
        @error('fecha_real')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>