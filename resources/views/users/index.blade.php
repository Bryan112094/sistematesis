@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="m-0">Usuarios</h3>
                    </div>
                    <div class="col-4 text-end">
                        <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">Agregar</a>
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
                    <div class="table-responsive"><table class="table table-striped align-middle">
                        <thead><tr>
                            <th scope="col">CARGO</th>
                            <th scope="col">NOMBRE&nbsp;COMPLETO</th>
                            <th scope="col">CORREO&nbsp;ELECTRÓNICO</th>
                            <th scope="col" width="100">OPCIONES</th>
                        </tr></thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->cargo }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="d-flex gap-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-icon btn-outline-info btn-sm"><i class="fa-regular fa-pen-to-square"></i></a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-icon btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table></div>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $users->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
