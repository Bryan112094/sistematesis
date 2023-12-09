@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Crear caso de prueba</h3>
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('casos_prueba.index', [$project->id, $requirement->id]) }}" class="btn btn-danger btn-sm">Retornar</a>
                    </div>
                </div></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('casos_prueba.store', [$project->id, $requirement->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proyecto_id" id="proyecto_id" value="{{ $project->id }}">
                        <input type="hidden" name="requerimiento_id" id="requerimiento_id" value="{{ $requirement->id }}">
                        <input type="hidden" name="creado_id" id="creado_id" value="{{ Auth::user()->id }}">
                        <div class="row mb-3">
                            <label for="nom_pr" class="col-md-4 col-form-label text-md-end">Proyecto</label>
                            <div class="col-md-6">
                                <input type="text" id="nom_pr" name="nom_pr" disabled class="form-control form-control-sm" value="{{ $project->nombre }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nom_rq" class="col-md-4 col-form-label text-md-end">Requerimiento</label>
                            <div class="col-md-6">
                                <input type="text" id="nom_rq" name="nom_rq" disabled class="form-control form-control-sm" value="{{ $requirement->nombre }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="codigo" class="col-md-4 col-form-label text-md-end">Código</label>
                            <div class="col-md-6">
                                @if (isset($new_cod))
                                    <input type="text" id="codigo" name="codigo" readonly class="form-control form-control-sm @error('codigo') is-invalid @enderror" value="{{ old('codigo', $new_cod) }}">
                                @else
                                    <input type="text" id="codigo" name="codigo" readonly class="form-control form-control-sm @error('codigo') is-invalid @enderror" value="{{ old('codigo', $caso_prueba->codigo) }}">
                                @endif
                                @error('codigo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="resumen" class="col-md-4 col-form-label text-md-end">Resumen</label>
                            <div class="col-md-6">
                                <textarea name="resumen" id="resumen" class="form-control form-control-sm @error('resumen') is-invalid @enderror" rows="5">{{ old('resumen', $caso_prueba->resumen) }}</textarea>
                                @error('resumen')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="proposito" class="col-md-4 col-form-label text-md-end">Propósito</label>
                            <div class="col-md-6">
                                <input type="text" id="proposito" name="proposito" class="form-control form-control-sm @error('proposito') is-invalid @enderror" value="{{ old('proposito', $caso_prueba->proposito) }}">
                                @error('proposito')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="precondicion" class="col-md-4 col-form-label text-md-end">Precondición</label>
                            <div class="col-md-6">
                                <input type="text" id="precondicion" name="precondicion" class="form-control form-control-sm @error('precondicion') is-invalid @enderror" value="{{ old('precondicion', $caso_prueba->precondicion) }}">
                                @error('precondicion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="datos_entrada" class="col-md-4 col-form-label text-md-end">Datos de entrada</label>
                            <div class="col-md-6">
                                <input type="text" id="datos_entrada" name="datos_entrada" class="form-control form-control-sm @error('datos_entrada') is-invalid @enderror" value="{{ old('datos_entrada', $caso_prueba->datos_entrada) }}">
                                @error('datos_entrada')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="caracteristicas" class="col-md-4 col-form-label text-md-end">Características</label>
                            <div class="col-md-6">
                                <select id="caracteristicas" name="caracteristicas[]" multiple class="form-select @error('caracteristicas') is-invalid @enderror">
                                @foreach($caracteristicas as $caracteristica)
                                    <option value="{{ $caracteristica['id'] }}">{{ $caracteristica['titulo'] }}</option>
                                @endforeach
                                </select>
                                @error('caracteristicas')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="criticidad" class="col-md-4 col-form-label text-md-end">Criticidad</label>
                            <div class="col-md-6">
                                <select id="criticidad" name="criticidad" class="form-select @error('criticidad') is-invalid @enderror">
                                @foreach($criticidads as &$criticidad)
                                    <option value="{{ $criticidad }}" @if($criticidad==$caso_prueba->criticidad) Selected @endif>{{ $criticidad }}</option>
                                @endforeach
                                </select>
                                @error('criticidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="spring" class="col-md-4 col-form-label text-md-end">Spring</label>
                            <div class="col-md-6">
                                <select id="spring" name="spring" class="form-select">
                                    <option value="0" @if(0==$caso_prueba->spring) Selected @endif> --- </option>
                                    <option value="1" @if(1==$caso_prueba->spring) Selected @endif> 1 </option>
                                    <option value="2" @if(2==$caso_prueba->spring) Selected @endif> 2 </option>
                                    <option value="3" @if(3==$caso_prueba->spring) Selected @endif> 3 </option>
                                    <option value="4" @if(4==$caso_prueba->spring) Selected @endif> 4 </option>
                                    <option value="5" @if(5==$caso_prueba->spring) Selected @endif> 5 </option>
                                    <option value="6" @if(6==$caso_prueba->spring) Selected @endif> 6 </option>
                                    <option value="7" @if(7==$caso_prueba->spring) Selected @endif> 7 </option>
                                    <option value="8" @if(8==$caso_prueba->spring) Selected @endif> 8 </option>
                                    <option value="9" @if(9==$caso_prueba->spring) Selected @endif> 9 </option>
                                    <option value="10" @if(10==$caso_prueba->spring) Selected @endif> 10 </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="tiempo_estimado" class="col-md-4 col-form-label text-md-end">Tiempo estimado</label>
                            <div class="col-md-6">
                                <input type="text" id="tiempo_estimado" name="tiempo_estimado" class="form-control form-control-sm @error('tiempo_estimado') is-invalid @enderror" value="{{ old('tiempo_estimado', $caso_prueba->tiempo_estimado) }}">
                                @error('tiempo_estimado')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
