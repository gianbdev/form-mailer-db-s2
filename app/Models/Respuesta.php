<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    use HasFactory;

    protected $table = 'respuestas';

    protected $primaryKey = 'respuestaID';

    protected $fillable = [
        'reclamoID',
        'asistenteID',
        'fechaRespuesta',
        'detalleRespuesta',
    ];

    public function reclamo()
    {
        return $this->belongsTo(Reclamo::class, 'reclamoID');
    }

    public function asistente()
    {
        return $this->belongsTo(Asistente::class, 'asistenteID');
    }
}
