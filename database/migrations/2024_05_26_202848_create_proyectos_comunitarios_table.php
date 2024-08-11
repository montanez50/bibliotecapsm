<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProyectosComunitariosTable extends Migration {

	public function up()
	{
		Schema::create('proyectos_comunitarios', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
			$table->string('tutor');
			$table->longText('descripcion');
		});
	}

	public function down()
	{
		Schema::drop('proyectos_comunitarios');
	}
}