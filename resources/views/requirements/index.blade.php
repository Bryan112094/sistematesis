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
                        <h3 class="m-0">Requerimientos</h3>
                    </div>
                    <div class="col-4 text-end">
                    @if (Auth::user()->cargo=='AD' || Auth::user()->cargo=='JP')
                        <a href="{{ route('requirements.create', $project->id) }}" class="btn btn-primary btn-sm">Agregar</a>
                    @endif
                    <a href="{{ route('projects.index') }}" class="btn btn-danger btn-sm">Retornar</a>
                    </div>
                </div></div>
                <div class="card-body">
                    <h5 class="pb-3"><strong>Proyecto:</strong> {{ $project->nombre }}</h5>
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
                            <th scope="col">NOMBRE</th>
                            <th scope="col">ANALISTA&nbsp;CALIDAD</th>
                            <th scope="col">FECHA&nbsp;TENTATIVA</th>
                            <th scope="col">FECHA&nbsp;REAL</th>
                            <th scope="col" width="100">ESTADO</th>
                            <th scope="col" width="100">OPCIONES</th>
                        </tr></thead>
                        <tbody>
                            @foreach($requirements as $requirement)
                            <tr>
                                <td>{{ $requirement->codigo }}</td>
                                <td>{{ $requirement->nombre }}</td>
                                <td>
                                @if(count($requirement->analistascalidad) > 0)
                                    @foreach($requirement->analistascalidad as $analista)
                                    @if (Auth::user()->cargo=='JC')
                                    <span class="d-block"><a href="{{ route('requirements.analista', [$project->id, $requirement->id]) }}" class="text-dark">{{ $analista->analistacalidad->name }}</a></span>
                                    @else
                                    <span class="d-block">{{ $analista->analistacalidad->name }}</span>
                                    @endif
                                    @endforeach
                                @else
                                    @if (Auth::user()->cargo=='JC')
                                    <span class="d-block"><a href="{{ route('requirements.analista', [$project->id, $requirement->id]) }}" class="text-dark">Sin analistas</a></span>
                                    @else
                                    <span class="d-block">Sin analistas</span>
                                    @endif
                                @endif
                                </td>
                                <td>
                                    @if (Auth::user()->cargo=='JC')
                                    <a href="{{ route('requirements.fecha_tentativa', [$project->id, $requirement->id]) }}" class="text-dark">{{ date('d-m-Y', strtotime($requirement->fecha_tentativa)) }}</a>
                                    @else
                                    {{ date('d-m-Y', strtotime($requirement->fecha_tentativa)) }}
                                    @endif
                                </td>
                                <td>@if(!empty($requirement->fecha_real)) {{ date('d-m-Y', strtotime($requirement->fecha_real)) }} @endif</td>
                                <td><span class="badge bg-{{ $estados['icono'][array_search($requirement->estado, $estados['titulo'])] }}">{{ $requirement->estado }}</span></td>
                                <td><div class="d-flex gap-2">
                                    @if (Auth::user()->cargo=='JP')
                                        <a href="{{ route('requirements.edit', [$project->id, $requirement->id]) }}" class="btn btn-outline-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Editar"><i class="fa-regular fa-pen-to-square"></i></a>
                                    @endif
                                    @if (Auth::user()->cargo=='JP' || Auth::user()->cargo=='JC')
                                    <a href="{{ route('requeriments.detail', [$project->id, $requirement->id]) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Historiales"><i class="fa-regular fa-eye"></i></a>
                                    @endif
                                    <a href="{{ route('casos_prueba.index', [$project->id, $requirement->id]) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Casos de prueba"><i class="fa-solid fa-magnifying-glass-plus"></i></a>
                                    @if (Auth::user()->cargo=='JP')
                                    <form action="{{ route('requirements.destroy', [$project->id, $requirement->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Eliminar"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                    @endif
                                </div></td>
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
