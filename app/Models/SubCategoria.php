<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;

    // Especificamos el nombre de la tabla en la base de datos
    protected $table = 'subcategorias'; // El nombre correcto de la tabla en la base de datos

    protected $fillable = ['nombre', 'categoria_id'];

    // Relación con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
