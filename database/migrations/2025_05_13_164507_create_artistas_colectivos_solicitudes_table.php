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
    Schema::create('solicitud_artista_colectivos', function (Blueprint $table) {
        $table->id();
        $table->string('departamento');
        $table->string('provincia');
        $table->string('municipio');
        $table->string('comunidad');
        $table->string('nombre_denominacion');
        $table->json('integrantes');
        $table->string('periodo_act');
        $table->string('telefono')->nullable();
        $table->string('celular');
        $table->string('correo');
        $table->foreignId('categoria_id')->constrained('categorias');
        $table->foreignId('sub_categoria_id')->constrained('subcategorias');
        $table->string('especialidad1');
        $table->text('antecedentes_grupo');
        $table->text('trayectoria');
        $table->string('logo');
        $table->string('ci_representante');
        $table->string('cv');
        $table->string('carta');
        $table->json('representante'); // Para guardar los datos como un JSON
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
        Schema::dropIfExists('artistas_colectivos_solicitudes');
    }
};
