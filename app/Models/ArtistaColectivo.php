<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ArtistaColectivo extends Model
{
    use HasFactory;

    protected $table = 'artistas_colectivos';

    protected $fillable = [
        'departamento', 'provincia', 'municipio', 'comunidad',
        'nombre_denominacion', 'integrantes', 'periodo_act',
        'telefono', 'celular', 'correo',
        'categoria_id', 'sub_categoria_id', 'especialidad1',
        'antecedentes_grupo', 'trayectoria',
        'representante_id', 'logo', 'ci_representante', 'cv', 'carta', 'estado' ,
    ];

    public function representante()
    {
        return $this->belongsTo(Representante::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'sub_categoria_id');
    }
}

