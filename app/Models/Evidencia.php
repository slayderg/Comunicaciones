<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evidencia extends Model
{
    use HasFactory;

    protected $fillable = ['accion_id', 'tipo', 'archivo'];

    public function accion()
    {
        return $this->belongsTo(Accion::class);
    }
}
