<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reclamo extends Model
{
    use HasFactory;

    protected $table = 'reclamos';

    protected $primaryKey = 'reclamoID';

    protected $fillable = [
        'tipo_reclamo',
        'nombre_cliente',
        'correo_cliente',
        'telefono_cliente',
        'dni_cliente',
        'productoID',
        'fecha_reclamo',
        'descripcion',
    ];



    public function producto()
    {
        //return $this->belongsTo(Producto::class, 'productoID');
        return $this->belongsTo(Producto::class, 'productoID', 'productoID');
    }

}
