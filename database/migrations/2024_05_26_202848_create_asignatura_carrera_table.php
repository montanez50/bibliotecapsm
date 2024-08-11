<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsignaturaCarreraTable extends Migration {

	public function up()
	{
		Schema::create('asignatura_carrera', function(Blueprint $table) {
			$table->foreignId('asignatura_id')->constrained('asignaturas')->onDelete('cascade');
			$table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('asignatura_carrera');
	}
}