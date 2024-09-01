<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administracion extends Model
{
    use HasFactory;

    protected $table = 'administracions';

    protected $primaryKey = 'AdministradorID';

    protected $fillable = [
        'nombre',
        'correo',
    ];
}
