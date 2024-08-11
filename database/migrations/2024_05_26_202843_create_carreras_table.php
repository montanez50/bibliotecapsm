<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarrerasTable extends Migration {

	public function up()
	{
		Schema::create('carreras', function(Blueprint $table) {
			$table->id('id');
			$table->string('nombre', 35);
		});
	}

	public function down()
	{
		Schema::drop('carreras');
	}
}