<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Streak extends Model
{
    use HasFactory;

    protected $fillable = ['titulo', 'descripcion', 'completada', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}