<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasColectivosTable extends Migration
{
    public function up()
    {
        Schema::create('artistas_colectivos', function (Blueprint $table) {
            $table->id();
            $table->string('departamento');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('comunidad');
            $table->string('nombre_denominacion');
            $table->json('integrantes');
            $table->text('periodo_act');
            $table->string('telefono')->nullable();
            $table->string('celular');
            $table->string('correo');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('sub_categoria_id')->constrained('subcategorias');
            $table->string('especialidad1');
            $table->text('antecedentes_grupo');
            $table->text('trayectoria');
            $table->foreignId('representante_id')->nullable()->constrained('representantes');
            $table->string('logo');
            $table->string('ci_representante');
            $table->string('cv');
            $table->string('carta');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artistas_colectivos');
    }
}
