<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function index()
    {
        if(Auth::user()->cargo == 'JP') $projects = Proyecto::where('jefe_proyecto_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate();
        elseif(Auth::user()->cargo == 'JC') $projects = Proyecto::where('jefe_calidad_id', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate();
        elseif(Auth::user()->cargo == 'AC') {
            $proyecto_id = AgregadoController::pr_rq_analista_calidad(Auth::user()->id);
            $projects = Proyecto::whereIn('id', $proyecto_id)->orderBy('created_at', 'DESC')->paginate();
        }else $projects = Proyecto::orderBy('created_at', 'DESC')->paginate();
        $estados = AgregadoController::estados_proyectos();

        return view('projects.index', compact('projects', 'estados'));
    }

    public function create()
    {
        $jefes = AgregadoController::jefesProyectos();
        $jefesc = AgregadoController::jefesCalidad();
        $estados = AgregadoController::estados_proyectos();
        $new_cod = AgregadoController::codProyecto(Auth::user()->id);
        $project = new Proyecto;
        return view('projects.create', compact('project', 'jefes', 'jefesc', 'estados', 'new_cod'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'codigo' => ['required', 'string', 'min:6', 'max:6'],
            'jefe_proyecto_id' => ['required', 'integer'],
            'jefe_calidad_id' => ['required', 'integer'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:100'],
            'estado' => ['required', 'string']
        ]);

        Proyecto::create($validate);

        return to_route('projects.index')->with('status', 'Agregado con éxito');

    }

    public function show(Proyecto $user)
    {
    }

    public function edit(Proyecto $project)
    {
        $jefes = AgregadoController::jefesProyectos();
        $jefesc = AgregadoController::jefesCalidad();
        $estados = AgregadoController::estados_proyectos();
        return view('projects.edit', compact('project', 'jefes', 'jefesc', 'estados'));
    }
    public function update(Request $request, Proyecto $project)
    {
        $validate = $request->validate([
            'codigo' => ['required', 'string', 'min:6', 'max:6'],
            'jefe_proyecto_id' => ['required', 'integer'],
            'jefe_calidad_id' => ['required', 'integer'],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['required', 'string', 'max:100'],
            'estado' => ['required', 'string']
        ]);

        $project->update($validate);

        return to_route('projects.index')->with('status', 'Actualizado con éxito.');
    }

    public function destroy(Proyecto $project)
    {
        $project->delete();
        return to_route('projects.index')->with('status', 'Eliminado con éxito.');
    }

    public function detail(Proyecto $project) {
        $array_analistas_nombres = array();
        foreach($project->analistascalidad as $item) {
            $analista = User::findOrFail($item->analista_calidad_id);
            array_push($array_analistas_nombres, $analista->name);
        }
        return view('projects.detail', compact('project', 'array_analistas_nombres'));
    }
}
