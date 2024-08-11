<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVisualizacionesTable extends Migration {

	public function up()
	{
		Schema::create('visualizaciones', function(Blueprint $table) {
			$table->increments('id');
			$table->foreignId('publicacion_id')->constrained('publicaciones');
			$table->foreignId('user_id')->constrained('users');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('visualizaciones');
	}
}