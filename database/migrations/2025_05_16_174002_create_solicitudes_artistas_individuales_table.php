<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitudes_artistas_individuales', function (Blueprint $table) {
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
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->foreignId('user_id')->constrained()->onDelete('restrict');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_artistas_individuales');
        Schema::table('solicitudes_artistas_individuales', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
    }
};
