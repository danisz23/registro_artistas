<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{

    Schema::table('solicitudes_artistas_individuales', function (Blueprint $table) {
        $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
    });
    Schema::table('solicitud_artista_colectivos', function (Blueprint $table) {
        $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
    });
    Schema::table('artistas_individuales', function (Blueprint $table) {
        $table->enum('estado', ['pendiente_entrega', 'entregado'])->default('pendiente_entrega');
    });

    Schema::table('artistas_colectivos', function (Blueprint $table) {
        $table->enum('estado', ['pendiente_entrega', 'entregado'])->default('pendiente_entrega');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('solicitudes_artistas_individuales', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('solicitud_artista_colectivos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('artistas_individuales', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('artistas_colectivos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
