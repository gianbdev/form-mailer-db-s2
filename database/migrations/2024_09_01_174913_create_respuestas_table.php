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
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id(); // Esta columna será auto_increment y será la clave primaria
            $table->unsignedBigInteger('reclamoID');
            $table->unsignedBigInteger('asistenteID');
            $table->date('fechaRespuesta');
            $table->text('detalleRespuesta');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('reclamoID')->references('reclamoID')->on('reclamos')->onDelete('cascade');
            $table->foreign('asistenteID')->references('asistenteID')->on('asistentes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respuestas');
    }
};
