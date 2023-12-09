@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Casos de prueba</h3>
                    </div>
                    <div class="col-4 text-end">
                    @if (Auth::user()->cargo=='AC')
                    <a href="{{ route('casos_prueba.create', [$project->id, $requirement->id]) }}" class="btn btn-primary btn-sm">Agregar</a>
                    @endif
                    <a href="{{ route('projects.requerimiento', $project->id) }}" class="btn btn-danger btn-sm">Retornar</a>
                    </div>
                </div></div>
                <div class="card-body">
                    <h5 class="pb-1"><strong>Proyecto:</strong> {{ $project->nombre }}</h5>
                    <h5 class="pb-3"><strong>Requerimiento:</strong> {{ $requirement->nombre }}</h5>
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                            <span class="m-0" style="font-size: 22px;line-height:22px"><i class="fa-solid fa-circle-check"></i></span>
                            <div>{{ session('status') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive"><table id="tabla" class="table table-striped align-middle">
                        <thead><tr>
                            <th scope="col">CÓDIGO</th>
                            <th scope="col">CREADOR</th>
                            <th scope="col">EJECUTOR</th>
                            <th scope="col">ESTADO</th>
                            <th scope="col">PROPÓSITO</th>
                            <th scope="col">PRECONDICIÓN</th>
                            <th scope="col">DATOS&nbsp;DE&nbsp;ENTRADA</th>
                            <th scope="col">CARACTERISTICAS</th>
                            <th scope="col">CRITICIDAD</th>
                            <th scope="col">SPRING</th>
                            <th scope="col">RESUMEN</th>
                            <th scope="col" width="100">OPCIONES</th>
                        </tr></thead>
                        <tbody>
                            @foreach($casos_pruebas as $casos_prueba)
                            <?php $caracs = explode(",", $casos_prueba->caracteristicas); ?>
                            <tr>
                                <td>{{ $casos_prueba->codigo }}</td>
                                <td>{{ $casos_prueba->creador->name }}</td>
                                <td>{{ !empty($casos_prueba->ejecutor_id) ? $casos_prueba->ejecutor->name : '' }}</td>
                                <td>{{ $casos_prueba->estado }}</td>
                                <td>{{ $casos_prueba->proposito }}</td>
                                <td>{{ $casos_prueba->precondicion }}</td>
                                <td>{{ $casos_prueba->datos_entrada }}</td>
                                <td>
                                @foreach ($caracteristicas as $item)
                                    @if (in_array($item['id'], $caracs))
                                        <span class="d-block">{{ $item['titulo'] }}</span>
                                    @endif
                                @endforeach
                                </td>
                                <td>{{ $casos_prueba->criticidad }}</td>
                                <td>{{ ($casos_prueba->spring==0) ? '--' : $casos_prueba->spring }}</td>
                                <td>{{ $casos_prueba->resumen }}</td>
                                <td>
                                    @if (Auth::user()->cargo=='AC')
                                        <a href="{{ route('casos_prueba.edit', [$project->id, $requirement->id, $casos_prueba->id]) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                    @endif
                                    @if (Auth::user()->cargo=='AC')
                                    <form action="{{ route('casos_prueba.destroy', [$project->id, $requirement->id, $casos_prueba->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready( function() {
            new DataTable('#tabla', {
                language : {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
                }
            });
        })
    </script>
@endsection
