<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTrabajosDeGradoTable extends Migration {

	public function up()
	{
		Schema::create('trabajos_de_grado', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
			$table->foreignId('linea_de_investigacion_id')->constrained('lineas_de_investigacion')->onDelete('cascade');
			$table->string('tutor');
			$table->longText('resumen');
			$table->string('descriptores');
			$table->string('mencion');
		});
	}

	public function down()
	{
		Schema::drop('trabajos_de_grado');
	}
}