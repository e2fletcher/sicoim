<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecepcionsProductosTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('recepcions_productos'))
		{
			Schema::create('recepcions_productos', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('recepcion_id')->unsigned();
				$table->bigInteger('producto_id')->unsigned();
				$table->foreign('recepcion_id')->references('id')->on('recepcions');
				$table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('recepcions_productos');
	}
}
