<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAutoresTable extends Migration {

	public function up()
	{
		Schema::create('autores', function(Blueprint $table) {
			$table->id('id');
			$table->string('nombre', 100);
		});
	}

	public function down()
	{
		Schema::drop('autores');
	}
}