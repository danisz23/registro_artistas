<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtistaIndividual extends Model
{
    use HasFactory;

    protected $table = 'artistas_individuales';

    protected $fillable = [
        'departamento', 'provincia', 'municipio', 'comunidad', 'domicilio',
        'ci', 'expedido', 'sexo', 'nombres', 'apellidos', 'lugar_nacimiento', 
        'fecha_nacimiento', 'telefono', 'celular', 'correo', 'antecedentes',
        'categoria_id', 'sub_categoria_id', 'especialidad1', 'biografia', 
        'fotografia', 'ci_pdf', 'cv',
    ];
        // Relación con la tabla 'Categoria'
        public function categoria()
        {
            return $this->belongsTo(Categoria::class);
        }
    
        // Relación con la tabla 'Subcategoria'
        public function subcategoria()
        {
            return $this->belongsTo(Subcategoria::class, 'sub_categoria_id');
        }
    
        // Accesor para obtener la URL completa de la fotografía
        public function getFotografiaUrlAttribute()
        {
            return asset('storage/' . $this->fotografia);
        }
    
        // Accesor para obtener la URL completa del archivo de CI
        public function getCiPdfUrlAttribute()
        {
            return asset('storage/' . $this->ci_pdf);
        }
    
        // Accesor para obtener la URL completa del CV
        public function getCvUrlAttribute()
        {
            return asset('storage/' . $this->cv);
        }
}
