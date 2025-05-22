<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriasTable extends Migration
{
    public function up()
    {
        Schema::create('categorias', function (Blueprint $table) {
            $table->id(); // Crea una columna de ID auto incremental
            $table->string('nombre'); // Columna para el nombre de la categoría
            $table->timestamps(); // Para las columnas created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('categorias');
    }
}
