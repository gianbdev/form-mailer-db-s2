<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla en la base de datos

    protected $primaryKey = 'productoID'; // Clave primaria de la tabla

    public $incrementing = true; // Si la clave primaria es un entero auto-incremental

    protected $keyType = 'int'; // Tipo de la clave primaria

    protected $fillable = [
        'nombre', 'tipo', 'precio', 'fechaVencimiento', 'laboratorio', 'descripcion'
    ];

}
