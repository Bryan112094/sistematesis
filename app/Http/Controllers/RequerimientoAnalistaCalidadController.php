<?php

namespace App\Http\Controllers;

use App\Models\HistorialRequerimientoAnalistaCalidad;
use App\Models\Proyecto;
use App\Models\Requerimiento;
use App\Models\RequerimientoAnalistaCalidad;
use App\Models\User;
use Illuminate\Http\Request;

class RequerimientoAnalistaCalidadController extends Controller
{
    public function analistas(Proyecto $project, Requerimiento $requirement) {
        $analistas = AgregadoController::analistasCalidad();
        $array_analistas_id = array();
        $array_analistas_nombres = array();
        foreach($requirement->analistascalidad as $item) {
            $analista = User::findOrFail($item->analista_calidad_id);
            array_push($array_analistas_id, $item->analista_calidad_id);
            array_push($array_analistas_nombres, $analista->name);
        }
        return view('requirement_analista.analista', compact('project', 'requirement', 'analistas', 'array_analistas_id', 'array_analistas_nombres'));
    }

    public function save_change(Proyecto $project, Requerimiento $requirement, Request $request) {
        $request->validate([
            'analista_calidad' => ['required'],
            'descripcion' => ['required', 'string'],
        ]);
        RequerimientoAnalistaCalidad::where('requerimiento_id', $requirement->id)->delete();
        $array_analistas_nombres = array();
        foreach($request->input('analista_calidad') as $item) {
            $analista = User::findOrFail($item);
            $data01 = [
                'requerimiento_id' => $requirement->id,
                'analista_calidad_id' => $analista->id
            ];
            RequerimientoAnalistaCalidad::create($data01);
            array_push($array_analistas_nombres, $analista->name);
        }
        $data = [
            'requerimiento_id' => $requirement->id,
            'analistas_antiguos' => $request->input('analistas_antiguos'),
            'analistas_nuevos' => implode(', ', $array_analistas_nombres),
            'descripcion' => $request->input('descripcion')
        ];
        HistorialRequerimientoAnalistaCalidad::create($data);
        return to_route('requirements.analista', [$project->id, $requirement->id])->with('status', 'Actualizado con éxito');
    }
}
