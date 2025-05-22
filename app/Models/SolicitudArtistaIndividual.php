<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudArtistaIndividual extends Model
{
     use HasFactory;

    protected $table = 'solicitudes_artistas_individuales';
        protected $fillable = [
        'departamento', 'provincia', 'municipio', 'comunidad', 'domicilio',
        'ci', 'expedido', 'sexo', 'nombres', 'apellidos', 'lugar_nacimiento',
        'fecha_nacimiento', 'telefono', 'celular', 'correo', 'antecedentes',
        'categoria_id', 'sub_categoria_id', 'especialidad1', 'biografia',
        'fotografia', 'ci_pdf', 'cv', 'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'sub_categoria_id');
    }
}
