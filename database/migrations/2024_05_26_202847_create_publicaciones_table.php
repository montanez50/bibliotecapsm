<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicacionesTable extends Migration {

	public function up()
	{
		Schema::create('publicaciones', function(Blueprint $table) {
			$table->id('id');
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->string('titulo', 255);
			$table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');
			$table->smallInteger('anio');
			$table->string('archivo');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('publicaciones');
	}
}