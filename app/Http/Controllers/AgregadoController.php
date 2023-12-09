<?php

namespace App\Http\Controllers;

use App\Models\CasosPrueba;
use App\Models\Proyecto;
use App\Models\Requerimiento;
use App\Models\RequerimientoAnalistaCalidad;
use App\Models\User;
use Illuminate\Http\Request;

class AgregadoController extends Controller
{
    static function cargos() {
        $cargos = [
            [ "id" => "AD", "titulo" => "Administrador" ],
            [ "id" => "JP", "titulo" => "Jefe Proyecto" ],
            [ "id" => "JC", "titulo" => "Jefe Calidad" ],
            [ "id" => "AC", "titulo" => "Analista Calidad" ],
            [ "id" => "AP", "titulo" => "Analista Programador" ],
            [ "id" => "CL", "titulo" => "Cliente" ],
        ];
        return $cargos;
    }
    static function estados_proyectos() {
        $estados = [
            "titulo" => ["Nuevo", "En curso", "Terminado"],
            "icono" => ["primary", "warning", "success"]
        ];
        return $estados;
    }
    static function estados_requerimientos() {
        $estados = [
            "titulo" => ["Nuevo", "En curso", "Terminado", "Desestimado"],
            "icono" => ["primary", "warning", "success", "danger"]
        ];
        return $estados;
    }
    static function codProyecto($id) {
        $cod = Proyecto::where('jefe_proyecto_id', $id)->orderBy('codigo', 'DESC')->limit(1)->get();
        $n_cod = (count($cod)>0) ? (substr($cod[0]->codigo, -4) + 1) : 1;

        switch (strlen($n_cod)) {
            case 1:
                $ceros = '000';
                break;
            case 2:
                $ceros = '00';
                break;
            case 3:
                $ceros = '0';
                break;
            default:
                $ceros = '';
        }
        $new_cod = 'PR'.$ceros.$n_cod;
        return $new_cod;
    }
    static function codRequerimiento($id) {
        $cod = Requerimiento::where('proyecto_id', $id)->orderBy('codigo', 'DESC')->limit(1)->get();
        $n_cod = (count($cod)>0) ? (substr($cod[0]->codigo, -4) + 1) : 1;

        switch (strlen($n_cod)) {
            case 1:
                $ceros = '000';
                break;
            case 2:
                $ceros = '00';
                break;
            case 3:
                $ceros = '0';
                break;
            default:
                $ceros = '';
        }
        $new_cod = 'RQ'.$ceros.$n_cod;
        return $new_cod;
    }
    static function codCasosPrueba($id) {
        $cod = CasosPrueba::where('requerimiento_id', $id)->orderBy('codigo', 'DESC')->limit(1)->get();
        $n_cod = (count($cod)>0) ? (substr($cod[0]->codigo, -4) + 1) : 1;

        switch (strlen($n_cod)) {
            case 1:
                $ceros = '00000';
                break;
            case 2:
                $ceros = '0000';
                break;
            case 3:
                $ceros = '000';
                break;
            case 4:
                $ceros = '00';
                break;
            case 5:
                $ceros = '0';
                break;
            default:
                $ceros = '';
        }
        $new_cod = 'TEST-CP'.$ceros.$n_cod;
        return $new_cod;
    }
    static function jefesProyectos(){
        $jefes = User::where('cargo', 'JP')->orderBy('created_at', 'DESC')->paginate(1000);
        return $jefes;
    }
    static function jefesCalidad(){
        $jefes = User::where('cargo', 'JC')->orderBy('created_at', 'DESC')->paginate(1000);
        return $jefes;
    }
    static function analistasCalidad(){
        $analistas = User::where('cargo', 'AC')->orderBy('created_at', 'DESC')->paginate(1000);
        return $analistas;
    }
    static function pr_rq_analista_calidad($id) {
        $requerimientos = RequerimientoAnalistaCalidad::where('analista_calidad_id', $id)->orderBy('created_at', 'DESC')->paginate(1000);
        $projects_id = array();
        foreach ($requerimientos as $requerimiento) {
            $proyecto = Requerimiento::where('id', $requerimiento->requerimiento_id)->get();
            array_push($projects_id, $proyecto[0]->proyecto_id);
        }
        return $projects_id;
    }
    static function rq_analista_calidad($project_id, $id) {
        $requerimientos = Requerimiento::where('proyecto_id', $project_id)->get();
        $requerimiento_id = array();
        foreach ($requerimientos as $requerimiento) {
            $rqs = RequerimientoAnalistaCalidad::where('analista_calidad_id', $id)->where('requerimiento_id', $requerimiento->id)->get();
            foreach ($rqs as $rq) {
                array_push($requerimiento_id, $rq->requerimiento_id);
            }

        }

        return $requerimiento_id;
    }
}