@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Editar Fecha Tentativa</h3>
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
                    <form method="POST" action="{{ route('requirements.save_date', [$project->id, $requirement->id]) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <p class="mb-1"><strong class="text-decoration-underline">Proyecto:</strong> {{ $project->nombre }}</p>
                            <p class="mb-1"><strong class="text-decoration-underline">Jefe de proyecto:</strong> {{ $project->jefeproyecto->name }}</p>
                            <p class="mb-1"><strong class="text-decoration-underline">Jefe de calidad:</strong> {{ $project->jefecalidad->name }}</p>
                            <p class="mb-1"><strong class="text-decoration-underline">Requerimiento:</strong> {{ $requirement->nombre }}</p>
                            <p><strong class="text-decoration-underline">Fecha tentativa:</strong> {{ date('d-m-Y', strtotime($requirement->fecha_tentativa)) }}</p>
                        </div>
                        <div class="row mb-3">
                            <label for="fecha_tentativa" class="col-md-2 col-form-label">Fecha tentativa a cambiar</label>
                            <div class="col-md-4">
                                <input id="fecha_tentativa" type="date" class="form-control form-control-sm @error('fecha_tentativa') is-invalid @enderror" name="fecha_tentativa" value="{{ old('fecha_tentativa', date('Y-m-d', strtotime($requirement->fecha_tentativa))) }}" autocomplete="fecha_tentativa">
                                @error('fecha_tentativa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="descripcion" class="col-md-2 col-form-label">Descripción del cambio:</label>
                            <div class="col-md-10">
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
