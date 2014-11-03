<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRedireccionamientoSlugTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('slug_viejo_proyecto', function($table)
		{
			$table->increments('id');
			$table->string('slug');
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
		Schema::drop('slug_viejo_proyecto');
	}
}