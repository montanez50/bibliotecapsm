<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLineasDeInvestigacionTable extends Migration {

	public function up()
	{
		Schema::create('lineas_de_investigacion', function(Blueprint $table) {
			$table->id('id');
			$table->string('nombre', 50);
			$table->foreignId('carrera_id')->constrained('carreras')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('lineas_de_investigacion');
	}
}