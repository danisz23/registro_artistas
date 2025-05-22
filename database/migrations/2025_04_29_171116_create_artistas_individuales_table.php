<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistasIndividualesTable extends Migration
{
    public function up()
    {
        Schema::create('artistas_individuales', function (Blueprint $table) {
            $table->id();
            $table->string('departamento');
            $table->string('provincia');
            $table->string('municipio');
            $table->string('comunidad');
            $table->string('domicilio');
            $table->string('ci');
            $table->string('expedido');
            $table->enum('sexo', ['Masculino', 'Femenino', 'Otro']);
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('lugar_nacimiento');
            $table->date('fecha_nacimiento');
            $table->string('telefono')->nullable();
            $table->string('celular');
            $table->string('correo');
            $table->text('antecedentes');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->foreignId('sub_categoria_id')->constrained('subcategorias');
            $table->string('especialidad1');
            $table->text('biografia');
            $table->string('fotografia');
            $table->string('ci_pdf');
            $table->string('cv');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artistas_individuales');
    }
}
