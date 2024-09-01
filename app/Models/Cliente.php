<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = 'clienteID';

    protected $fillable = [
        'nombre',
        'correo',
        'telefono',
    ];

    public function reclamos()
    {
        return $this->hasMany(Reclamo::class, 'clienteID');
    }
}
