<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requerimiento extends Model
{
    use HasFactory;
    protected $fillable = ['proyecto_id', 'codigo', 'nombre', 'fecha_tentativa', 'fecha_real', 'estado'];
    public function analistascalidad() {
        return $this->hasMany('App\Models\RequerimientoAnalistaCalidad', 'requerimiento_id', 'id');
    }
    public function historialanalistacalidad() {
        return $this->hasMany('App\Models\HistorialRequerimientoAnalistaCalidad', 'requerimiento_id', 'id');
    }
    public function historialfechatentativa() {
        return $this->hasMany('App\Models\HistorialRequerimientoFechaTentativa', 'requerimiento_id', 'id');
    }
}
