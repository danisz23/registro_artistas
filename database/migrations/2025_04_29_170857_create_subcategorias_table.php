<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubcategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->id(); // Crea una columna de ID auto incremental
            $table->foreignId('categoria_id')->constrained('categorias'); // Relaciona la subcategoría con la categoría
            $table->string('nombre'); // Columna para el nombre de la subcategoría
            $table->timestamps(); // Para las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('subcategorias');
    }
}
