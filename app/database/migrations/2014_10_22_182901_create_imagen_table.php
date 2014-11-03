<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('imagen', function($table)
		{
			$table->increments('id');
			$table->string('ruta');
			$table->string('nombre_archivo');
			$table->integer('orden');
			$table->integer('proyecto_id')->unsigned();
			$table->foreign('proyecto_id')->references('id')->on('proyecto')->onDelete('CASCADE');
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
		Schema::drop('imagen');
	}

}
