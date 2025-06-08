<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id', 'nombre', 'descripcion', 'estado', 'fecha_inicio', 'fecha_fin'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
