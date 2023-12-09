<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CasosPrueba extends Model
{
    use HasFactory;
    protected $fillable = [
        'proyecto_id',
        'requerimiento_id',
        'creado_id',
        'codigo',
        'resumen',
        'proposito',
        'precondicion',
        'datos_entrada',
        'caracteristicas',
        'criticidad',
        'spring',
        'tiempo_estimado',
        'estado_jp',
        'estado_jc',
        'ejecutor_id',
        'estado'
    ];
    public function creador() {
        return $this->hasOne('App\Models\User', 'id', 'creado_id');
    }
    public function ejecutor() {
        return $this->hasOne('App\Models\User', 'id', 'ejecutor_id');
    }
}
