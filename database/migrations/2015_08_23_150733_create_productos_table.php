<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
	public function up()
	{
		if(!Schema::hasTable('productos'))
		{
			Schema::create('productos', function(Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('sucursal_id')->unsigned();
				$table->integer('tipo_id')->unsigned();
				$table->float('precio');
				$table->integer('stock');
				$table->foreign('tipo_id')->references('id')->on('tipos');
				$table->foreign('sucursal_id')->references('id')->on('sucursals');
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('productos');
	}
}
