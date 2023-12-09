    <thead><tr>
        <th scope="col">CÓDIGO</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">JEFE&nbsp;PROYECTO</th>
        <th scope="col">JEFE&nbsp;CALIDAD</th>
        <th scope="col">DESCRIPCIÓN</th>
        <th scope="col">ESTADO</th>
        <th scope="col" width="80">OPCIONES</th>
    </tr></thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->codigo }}</td>
            <td>{{ $project->nombre }}</td>
            <td>{{ $project->jefeproyecto->name }}</td>
            <td>{{ $project->jefecalidad->name }}</td>
            <td>{{ $project->descripcion }}</td>
            <td><span class="badge bg-{{ $estados['icono'][array_search($project->estado, $estados['titulo'])] }}">{{ $project->estado }}</span></td>
            <td><div class="d-flex gap-2">
                <a href="{{ route('projects.requerimiento', $project->id) }}" class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Requerimientos"><i class="fa-solid fa-rectangle-list"></i></a>
            </div></td>
        </tr>
        @endforeach
    </tbody>