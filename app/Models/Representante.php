<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Representante extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres', 'apellidos', 'ci', 'expedido',
        'lugar_nacimiento', 'fecha_nacimiento', 'domicilio',
    ];

    public function colectivos()
    {
        return $this->hasMany(ArtistaColectivo::class);
    }
}