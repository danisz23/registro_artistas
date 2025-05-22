<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudArtistaColectivo extends Model
{
    use HasFactory;

    protected $table = 'solicitud_artista_colectivos';

    protected $fillable = [
        'departamento',
        'provincia',
        'municipio',
        'comunidad',
        'nombre_denominacion',
        'integrantes',
        'periodo_act',
        'telefono',
        'celular',
        'correo',
        'categoria_id',
        'sub_categoria_id',
        'especialidad1',
        'antecedentes_grupo',
        'trayectoria',
        'logo',
        'ci_representante',
        'cv',
        'carta',
        'representante',
    ];

    protected $casts = [
        'integrantes' => 'array',
        'representante' => 'array',
    ];

    // Relaciones (opcional, si deseas acceder a los nombres desde los modelos)
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'sub_categoria_id');
    }
    
    public function representante()
    {
        // Depende de cómo esté estructurada la base
        // Si la relación es One-to-One y la tabla tiene representante_id, por ejemplo:
        return $this->belongsTo(Representante::class, 'representante_id');

        // O si el representante está en la misma tabla, pero con prefijo, puedes usar:
        // return $this->hasOne(Representante::class, 'solicitud_id');
    }
}
