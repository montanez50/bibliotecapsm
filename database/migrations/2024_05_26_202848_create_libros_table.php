<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLibrosTable extends Migration {

	public function up()
	{
		Schema::create('libros', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
			$table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
			$table->decimal('dewey');
			$table->string('ISBN');
			$table->foreignId('editorial_id')->constrained('editoriales')->onDelete('cascade');
			$table->integer('edicion')->unsigned();
			$table->integer('ejemplares')->unsigned();
			$table->string('estado');
		});
	}

	public function down()
	{
		Schema::drop('libros');
	}
}