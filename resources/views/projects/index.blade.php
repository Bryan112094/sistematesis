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
                        <h3 class="m-0">Proyectos</h3>
                    </div>
                    @if (Auth::user()->cargo=='AD' || Auth::user()->cargo=='JP')
                    <div class="col-4 text-end">
                        <a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm">Agregar</a>
                    </div>
                    @endif
                </div></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success d-flex align-items-center gap-2 alert-dismissible fade show" role="alert">
                            <span class="m-0" style="font-size: 22px;line-height:22px"><i class="fa-solid fa-circle-check"></i></span>
                            <div>{{ session('status') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive"><table id="tabla" class="table table-striped align-middle">
                        @if (Auth::user()->cargo=='AD' || Auth::user()->cargo=='JP')
                            @include('projects.Principales.tabla')
                        @elseif (Auth::user()->cargo=='JC')
                            @include('projects.jefecalidad.tabla')
                        @elseif (Auth::user()->cargo=='AC')
                            @include('projects.analistacalidad.tabla')
                        @endif
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
