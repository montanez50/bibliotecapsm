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
        Schema::create('guias_academicas', function (Blueprint $table) {
            $table->id('id');
			$table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
			$table->longText('descripcion');
			$table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guias_academicas');
    }
};
