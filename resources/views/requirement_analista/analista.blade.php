@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Editar Analistas Calidad</h3>
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('projects.requerimiento', $project->id) }}" class="btn btn-danger btn-sm">Retornar</a>
                    </div>
                </div></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                            <span class="m-0" style="font-size: 22px;line-height:22px"><i class="fa-solid fa-circle-check"></i></span>
                            <div>{{ session('status') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('requirements.save_analista', [$project->id, $requirement->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <p class="mb-1"><strong class="text-decoration-underline">Proyecto:</strong> {{ $project->nombre }}</p>
                            <p class="mb-1"><strong class="text-decoration-underline">Jefe de proyecto:</strong> {{ $project->jefeproyecto->name }}</p>
                            <p class="mb-1"><strong class="text-decoration-underline">Jefe de calidad:</strong> {{ $project->jefecalidad->name }}</p>
                            <p class="mb-1"><strong class="text-decoration-underline">Analistas de calidad:</strong> {{ implode(', ', $array_analistas_nombres) }}</p>
                            <p><strong class="text-decoration-underline">Requerimiento:</strong> {{ $requirement->nombre }}</p>
                        </div>
                        <input type="hidden" id="analistas_antiguos" name="analistas_antiguos" value="{{ implode(', ', $array_analistas_nombres) }}">
                        <div class="row mb-3">
                            <label for="analista_calidad" class="col-md-2 col-form-label">Analistas Calidad a cambiar: </label>
                            <div class="col-md-6">
                                <select id="analista_calidad" name="analista_calidad[]" class="form-select form-select-sm @error('analista_calidad') is-invalid @enderror"" multiple>
                                    @foreach($analistas as $analista)
                                        <option value="{{ $analista->id }}"  {{ in_array($analista->id, $array_analistas_id) ? 'Selected' : '' }} >{{ $analista->name }}</option>
                                    @endforeach
                                </select>
                                @error('analista_calidad')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion" class="col-md-2 col-form-label">Descripción del cambio:</label>
                            <div class="col-md-8">
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-2">
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
