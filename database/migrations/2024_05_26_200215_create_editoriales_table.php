<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEditorialesTable extends Migration {

	public function up()
	{
		Schema::create('editoriales', function(Blueprint $table) {
			$table->id('id');
			$table->string('nombre', 50);
		});
	}

	public function down()
	{
		Schema::drop('editoriales');
	}
}