<?php

// database/seeders/CategoriasSubcategoriasSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Subcategoria;

class CategoriasSubcategoriasSeeder extends Seeder
{
    public function run()
    {
        // Crear las categorías
        $categorias = [
            'Artes Musicales' => [
                'Autóctona Originaria',
                'Folklórica',
                'Música Clásica',
                'Música Popular Contemporánea (Rock, Jazz, Blues, Tropical, Hip Hop, Otros)',
                'Música Experimental',
            ],
            'Artes Escénicas' => [
                'Cuenta Cuentos',
                'Danza Autóctona',
                'Danza Clásica',
                'Danza Contemporánea',
                'Danza Folklórica Boliviana',
                'Danza Internacional',
                'Mimo',
                'Payaso',
                'Teatro',
                'Títeres',
                'Artes Circenses',
            ],
            'Artes Plásticas' => [
                'Cerámica',
                'Dibujo',
                'Diseño Gráfico',
                'Escultura',
                'Grabado',
                'Pintura',
            ],
            'Textiles' => [
                'Tejido Originario',
            ],
            'Orfebrería' => [
                'Arte Originario',
            ],
            'Artes Audiovisuales' => [
                'Audiovisual Digital',
                'Cine',
                'Fotografía',
                'Video',
            ],
            'Artes Literarias' => [
                'Cuento',
                'Novela',
                'Ensayo',
            ],
            'Artes Populares' => [
                'Bordadores',
                'Mascareros',
            ],
            'Arte Alternativo' => [],
        ];

        // Insertar las categorías y subcategorías
        foreach ($categorias as $categoriaNombre => $subcategorias) {
            // Crear la categoría
            $categoria = Categoria::create(['nombre' => $categoriaNombre]);

            // Crear las subcategorías
            foreach ($subcategorias as $subcategoriaNombre) {
                Subcategoria::create([
                    'nombre' => $subcategoriaNombre,
                    'categoria_id' => $categoria->id,
                ]);
            }
        }
    }
}
