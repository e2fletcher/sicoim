<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciasProductosTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('transferencias_productos'))
		{
			Schema::create('transferencias_productos', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('transferencia_id')->unsigned();
				$table->bigInteger('producto_id')->unsigned();
				$table->foreign('transferencia_id')->references('id')->on('transferencias');
				$table->foreign('producto_id')->references('id')->on('productos');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('transferencias_productos');
	}
}
