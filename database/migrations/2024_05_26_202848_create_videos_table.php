<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVideosTable extends Migration {

	public function up()
	{
		Schema::create('videos', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
			$table->longText('descripcion');
			$table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('videos');
	}
}