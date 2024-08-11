<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAsignaturasTable extends Migration {

	public function up()
	{
		Schema::create('asignaturas', function(Blueprint $table) {
			$table->id('id');
			$table->string('nombre', 50);
		});
	}

	public function down()
	{
		Schema::drop('asignaturas');
	}
}