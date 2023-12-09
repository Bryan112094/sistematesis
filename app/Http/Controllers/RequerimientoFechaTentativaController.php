<?php

namespace App\Http\Controllers;

use App\Models\HistorialRequerimientoFechaTentativa;
use App\Models\Proyecto;
use App\Models\Requerimiento;
use Illuminate\Http\Request;

class RequerimientoFechaTentativaController extends Controller
{
    public function index(Proyecto $project, Requerimiento $requirement) {
        return view('requirement_fecha_tentativa.index', compact('project', 'requirement'));
    }
    public function save_date(Proyecto $project, Requerimiento $requirement, Request $request) {
        $request->validate([
            'fecha_tentativa' => ['required'],
            'descripcion' => ['required', 'string'],
        ]);

        $data01 = [
            'fecha_tentativa' => $request->input('fecha_tentativa'),
        ];

        $data = [
            'requerimiento_id' => $requirement->id,
            'fecha_antigua' => $requirement->fecha_tentativa,
            'fecha_nueva' => $request->input('fecha_tentativa'),
            'descripcion' => $request->input('descripcion')
        ];

        HistorialRequerimientoFechaTentativa::create($data);

        $requirement->update($data01);

        return to_route('requirements.fecha_tentativa', [$project->id, $requirement->id])->with('status', 'Actualizado con éxito');
    }
}
