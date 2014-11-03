<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('proyecto', function($table)
		{
			$table->increments('id');
			$table->string('titulo');
			$table->string('slug')->unique();
			$table->string('ubicacion');
			$table->string('superficie');
			$table->string('ano');
			$table->integer('categoria_id')->unsigned();
			$table->foreign('categoria_id')->references('id')->on('categoria')->onDelete('CASCADE');
			$table->string('descripcion_corta');
			$table->longText('descripcion');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('user');
			$table->integer('contadorFotos');
			$table->integer('orden');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('proyecto');
	}

}
