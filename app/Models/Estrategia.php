<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estrategia extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'titulo',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    /** Relación con áreas */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    /** Relación con acciones */
    public function acciones()
    {
        return $this->hasMany(Accion::class);
    }
}
