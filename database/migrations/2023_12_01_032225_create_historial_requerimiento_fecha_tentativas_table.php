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
        Schema::create('historial_requerimiento_fecha_tentativas', function (Blueprint $table) {
            $table->id();
            $table->integer('requerimiento_id');
            $table->dateTime('fecha_antigua');
            $table->dateTime('fecha_nueva');
            $table->longText('descripcion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_requerimiento_fecha_tentativas');
    }
};
