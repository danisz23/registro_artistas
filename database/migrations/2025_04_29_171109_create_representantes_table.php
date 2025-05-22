<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepresentantesTable extends Migration
{
    public function up()
    {
        Schema::create('representantes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('ci');
            $table->string('expedido');
            $table->string('lugar_nacimiento');
            $table->date('fecha_nacimiento');
            $table->string('domicilio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('representantes');
    }
}
