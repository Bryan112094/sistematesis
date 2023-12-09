@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Crear Requerimiento</h3>
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('projects.requerimiento', $project->id) }}" class="btn btn-danger btn-sm">Retornar</a>
                    </div>
                </div></div>
                <div class="card-body">
                    <form method="POST" action="{{ route('requirements.store', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proyecto_id" id="proyecto_id" value="{{ $project->id }}">
                        @include('requirements.form')
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
