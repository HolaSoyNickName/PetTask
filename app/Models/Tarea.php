<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'materia',
        'descripcion',
        'estado',
        'user_id',
    ];

    // RELACIÓN: Una tarea pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
