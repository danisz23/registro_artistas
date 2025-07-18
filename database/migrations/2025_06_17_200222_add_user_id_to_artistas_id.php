<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('artistas_colectivos', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id')->nullable();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // Elimina artista si se elimina el usuario
        });
    }

    public function down(): void
    {
        Schema::table('artistas_colectivos', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
