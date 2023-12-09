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
        Schema::create('casos_pruebas', function (Blueprint $table) {
            $table->id();
            $table->integer('proyecto_id');
            $table->integer('requerimiento_id');
            $table->integer('creado_id');
            $table->string('codigo', 13);
            $table->string('resumen', 100);
            $table->string('proposito', 50);
            $table->string('precondicion', 50);
            $table->string('datos_entrada', 50);
            $table->string('caracteristicas', 20);
            $table->string('criticidad', 20);
            $table->integer('spring')->nullable();
            $table->string('tiempo_estimado');
            $table->string('estado_jp')->nullable();
            $table->string('estado_jc')->nullable();
            $table->integer('ejecutor_id')->nullable();
            $table->string('estado')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casos_pruebas');
    }
};
