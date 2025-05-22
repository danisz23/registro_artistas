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
        $table->string('estado')->default('pendiente');
    });
}

public function down()
{
    Schema::table('solicitudes_artistas_individuales', function (Blueprint $table) {
        $table->dropColumn('estado');
    });
}

};
