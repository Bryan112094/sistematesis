<?php

namespace App\Http\Controllers;

use App\Models\CasosPrueba;
use App\Models\Proyecto;
use App\Models\Requerimiento;
use Illuminate\Http\Request;

class CasosPruebaController extends Controller
{
    private function caracteristicas() {
        $caracteristica = [
            [ "id" => "1", "titulo" => "Funcionalidad" ],
            [ "id" => "2", "titulo" => "Fiabilidad" ],
            [ "id" => "3", "titulo" => "Usabilidad" ],
            [ "id" => "4", "titulo" => "Eficiencia" ],
            [ "id" => "5", "titulo" => "Mentenibilidad" ],
            [ "id" => "6", "titulo" => "Portabilidad" ],
        ];
        return $caracteristica;
    }
    private function criticidad() {
        $critico = ["Ninguno", "Alta", "Media", "Baja"];
        return $critico;
    }
    private function estados() {
        $estados = ["Bloqueante", "Fallido", "Satisfactorio"];
        return $estados;
    }
    public function index(Proyecto $project, Requerimiento $requirement)
    {
        $casos_pruebas = CasosPrueba::where('requerimiento_id', $requirement->id)->get();
        $caracteristicas = $this->caracteristicas();
        return view('casos_prueba.index', compact('casos_pruebas', 'project', 'requirement', 'caracteristicas'));
    }
    public function create(Proyecto $project, Requerimiento $requirement)
    {
        $new_cod = AgregadoController::codCasosPrueba($requirement->id);
        $caracteristicas = $this->caracteristicas();
        $criticidads = $this->criticidad();
        $caso_prueba = new CasosPrueba;
        return view('casos_prueba.create', compact('requirement', 'project', 'caso_prueba', 'new_cod', 'caracteristicas', 'criticidads'));
    }
    public function store(Proyecto $project, Requerimiento $requirement, Request $request)
    {
        $request->validate([
            'proyecto_id' => ['required', 'int'],
            'requerimiento_id' => ['required', 'int'],
            'creado_id' => ['required', 'int'],
            'codigo' => ['required', 'string', 'min:13', 'max:13'],
            'resumen' => ['required', 'string', 'max:100'],
            'proposito' => ['required', 'string', 'max:50'],
            'precondicion' => ['required', 'string', 'max:50'],
            'datos_entrada' => ['required', 'string', 'max:50'],
            'caracteristicas' => ['required'],
            'criticidad' => ['required'],
            'spring' => [],
            'tiempo_estimado' => ['required', 'string', 'max:30'],
        ]);
        $data = [
            'proyecto_id' => $request->input('proyecto_id'),
            'requerimiento_id' => $request->input('requerimiento_id'),
            'creado_id' => $request->input('creado_id'),
            'codigo' => $request->input('codigo'),
            'resumen' => $request->input('resumen'),
            'proposito' => $request->input('proposito'),
            'precondicion' => $request->input('precondicion'),
            'datos_entrada' => $request->input('datos_entrada'),
            'caracteristicas' => implode(",", $request->input('caracteristicas')),
            'criticidad' => $request->input('criticidad'),
            'spring' => $request->input('spring'),
            'tiempo_estimado' => $request->input('tiempo_estimado'),
        ];
        CasosPrueba::create($data);
        return to_route('casos_prueba.index', [$project->id, $requirement->id])->with('status', 'Agregado con éxito');
    }
    public function edit(Proyecto $project, Requerimiento $requirement, CasosPrueba $caso_prueba)
    {
        $estados = $this->estados();
        $caracteristicas = $this->caracteristicas();
        $criticidads = $this->criticidad();
        return view('casos_prueba.edit', compact('project', 'requirement', 'estados', 'caso_prueba', 'caracteristicas', 'criticidads'));
    }
    public function update(Request $request, Proyecto $project, Requerimiento $requirement, CasosPrueba $caso_prueba)
    {
        $request->validate([
            'proyecto_id' => ['required', 'int'],
            'requerimiento_id' => ['required', 'int'],
            'creado_id' => ['required', 'int'],
            'ejecutor_id' => ['required', 'int'],
            'estado' => ['required'],
            'codigo' => ['required', 'string', 'min:13', 'max:13'],
            'resumen' => ['required', 'string', 'max:100'],
            'proposito' => ['required', 'string', 'max:50'],
            'precondicion' => ['required', 'string', 'max:50'],
            'datos_entrada' => ['required', 'string', 'max:50'],
            'caracteristicas' => ['required'],
            'criticidad' => ['required'],
            'spring' => [],
            'tiempo_estimado' => ['required', 'string', 'max:30'],
        ]);
        $data = [
            'proyecto_id' => $request->input('proyecto_id'),
            'requerimiento_id' => $request->input('requerimiento_id'),
            'creado_id' => $request->input('creado_id'),
            'ejecutor_id' => $request->input('ejecutor_id'),
            'estado' => $request->input('estado'),
            'codigo' => $request->input('codigo'),
            'resumen' => $request->input('resumen'),
            'proposito' => $request->input('proposito'),
            'precondicion' => $request->input('precondicion'),
            'datos_entrada' => $request->input('datos_entrada'),
            'caracteristicas' => implode(",", $request->input('caracteristicas')),
            'criticidad' => $request->input('criticidad'),
            'spring' => $request->input('spring'),
            'tiempo_estimado' => $request->input('tiempo_estimado'),
        ];
        $caso_prueba->update($data);
        return to_route('casos_prueba.index', [$project->id, $requirement->id])->with('status', 'Actualizado con éxito');
    }
    public function destroy(Proyecto $project, Requerimiento $requirement, CasosPrueba $caso_prueba)
    {
        $caso_prueba->delete();
        return to_route('casos_prueba.index', [$project->id, $requirement->id])->with('status', 'Eliminado con éxito.');
    }
}
