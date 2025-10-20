<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'accions';

    protected $fillable = [
        
        'estrategia_id',
        'nombre',               // <— en vez de titulo
        'descripcion',
        'responsable',
        'estado',
        'fecha_planeada_inicio',// <— en vez de fecha_planeada
        'fecha_planeada_fin',   // <— en vez de fecha_cumplimiento
        'fecha_real_inicio',
        'fecha_real_fin',
        'porcentaje_avance',    // <— en vez de avance

    ];

    public function estrategia()
    {
        return $this->belongsTo(Estrategia::class);
    }
}


