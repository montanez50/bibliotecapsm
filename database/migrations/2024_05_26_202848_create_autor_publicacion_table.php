<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAutorPublicacionTable extends Migration {

	public function up()
	{
		Schema::create('autor_publicacion', function(Blueprint $table) {
			$table->foreignId('autor_id')->constrained('autores')->onDelete('cascade');
			$table->foreignId('publicacion_id')->constrained('publicaciones')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('autor_publicacion');
	}
}