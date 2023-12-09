<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Requerimiento;
use App\Models\RequerimientoAnalistaCalidad;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RequerimientoController extends Controller
{
    public function index(Proyecto $project)
    {
        if(Auth::user()->cargo == 'AC') {
            $requerimientos_id = AgregadoController::rq_analista_calidad($project->id, Auth::user()->id);
            $requirements = Requerimiento::whereIn('id', $requerimientos_id)->orderBy('created_at', 'DESC')->paginate();
        } else {
            $requirements = Requerimiento::where('proyecto_id', $project->id)->orderBy('created_at', 'DESC')->paginate();
        }
        $estados = AgregadoController::estados_requerimientos();
        return view('requirements.index', compact('project', 'requirements', 'estados'));
    }
    public function create(Proyecto $project)
    {
        $estados = AgregadoController::estados_requerimientos();
        $a_calidads = AgregadoController::analistasCalidad();
        $new_cod = AgregadoController::codRequerimiento($project->id);
        $analistas = array();
        $requirement = new Requerimiento;
        return view('requirements.create', compact('requirement', 'project', 'estados', 'a_calidads', 'analistas', 'new_cod'));
    }
    public function store(Proyecto $project, Request $request)
    {
        $validate = $request->validate([
            'proyecto_id' => ['required', 'int'],
            'codigo' => ['required', 'string', 'min:6', 'max:6'],
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_tentativa' => ['required'],
            'fecha_real' => [],
            'estado' => ['required', 'string']
        ]);
        $requerimiento = Requerimiento::create($validate);
        foreach ($request->input('analista_calidad') as &$analista) {
            $datos = [
                'requerimiento_id' => $requerimiento->id,
                'analista_calidad_id' => $analista
            ];
            RequerimientoAnalistaCalidad::create($datos);
        }
        return to_route('projects.requerimiento', $project->id)->with('status', 'Agregado con éxito');
    }
    public function edit(Proyecto $project, Requerimiento $requirement)
    {
        $estados = AgregadoController::estados_requerimientos();
        $a_calidads = AgregadoController::analistasCalidad();
        $analistas = array();
        foreach ($requirement->analistascalidad as $analista) {
            array_push($analistas, $analista->analista_calidad_id);
        }
        return view('requirements.edit', compact('project', 'requirement', 'estados', 'a_calidads', 'analistas'));
    }
    public function update(Request $request, Proyecto $project, Requerimiento $requirement)
    {
        $validate = $request->validate([
            'proyecto_id' => ['required', 'int'],
            'codigo' => ['required', 'string', 'min:6', 'max:6'],
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_tentativa' => ['required'],
            'fecha_real' => [],
            'estado' => ['required', 'string']
        ]);
        $requirement->update($validate);

        RequerimientoAnalistaCalidad::where('requerimiento_id', $requirement->id)->delete();

        foreach ($request->input('analista_calidad') as &$analista) {
            $datos = [
                'requerimiento_id' => $requirement->id,
                'analista_calidad_id' => $analista
            ];
            RequerimientoAnalistaCalidad::create($datos);
        }

        return to_route('projects.requerimiento', $project->id)->with('status', 'Actualizado con éxito.');
    }
    public function destroy(Proyecto $project, Requerimiento $requirement)
    {
        $requirement->delete();
        return to_route('projects.requerimiento', $project->id)->with('status', 'Eliminado con éxito.');
    }
    public function detail(Proyecto $project, Requerimiento $requirement) {
        $array_analistas_nombres = array();
        foreach($requirement->analistascalidad as $item) {
            $analista = User::findOrFail($item->analista_calidad_id);
            array_push($array_analistas_nombres, $analista->name);
        }
        return view('requirements.detail', compact('project', 'requirement', 'array_analistas_nombres'));
    }
}
