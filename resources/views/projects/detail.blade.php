@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Detalle del Proyecto</h3>
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('projects.index') }}" class="btn btn-danger btn-sm">Retornar</a>
                    </div>
                </div></div>
                <div class="card-body">
                    <div class="row mb-3">
                        <p class="mb-1"><strong class="text-decoration-underline">Proyecto:</strong> {{ $project->nombre }}</p>
                        <p class="mb-1"><strong class="text-decoration-underline">Jefe de proyecto:</strong> {{ $project->jefeproyecto->name }}</p>
                        <p class="mb-1"><strong class="text-decoration-underline">Jefe de calidad:</strong> {{ $project->jefecalidad->name }}</p>
                        <p class="mb-1"><strong class="text-decoration-underline">Analistas de calidad:</strong> {{ implode(', ', $array_analistas_nombres) }}</p>
                        <p class="mb-1"><strong class="text-decoration-underline">Fecha tentativa:</strong> {{ date('d-m-Y', strtotime($project->fecha_tentativa)) }}</p>
                        <p><strong class="text-decoration-underline">Fecha real:</strong> {{ (!empty($project->fecha_real) ? date('Y-m-d', strtotime($project->fecha_real)) : '') }}</p>
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <strong>HISTORIAL DE ANALISTAS DE CALIDAD</strong>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample"><div class="accordion-body">
                                    <div class="table-responsive"><table class="table table-striped align-middle">
                                        <thead><tr>
                                            <th scope="col">FECHA HISTORIAL</th>
                                            <th scope="col">ANTES</th>
                                            <th scope="col">AHORA</th>
                                            <th scope="col">DESCRIPCIÓN</th>
                                        </tr></thead>
                                        <tbody>
                                            @foreach($project->historialanalistacalidad as $item)
                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ (!empty($item->analistas_antiguos) ? $item->analistas_antiguos : '--') }}</td>
                                                <td>{{ $item->analistas_nuevos }}</td>
                                                <td class="detail-project">{!! $item->descripcion !!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table></div>
                                </div></div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <strong>HISTORIA DE FECHAS TENTATIVAS</strong>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample"><div class="accordion-body">
                                    <div class="table-responsive"><table class="table table-striped align-middle">
                                        <thead><tr>
                                            <th scope="col">FECHA HISTORIAL</th>
                                            <th scope="col">ANTES</th>
                                            <th scope="col">AHORA</th>
                                            <th scope="col">DESCRIPCIÓN</th>
                                        </tr></thead>
                                        <tbody>
                                            @foreach($project->historialfechatentativa as $item)
                                            <tr>
                                                <td>{{ date('d-m-Y', strtotime($item->created_at)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->fecha_antigua)) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($item->fecha_nueva)) }}</td>
                                                <td class="detail-project">{!! $item->descripcion !!}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table></div>
                                </div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
