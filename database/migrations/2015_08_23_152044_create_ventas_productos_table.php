<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasProductosTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('ventas_productos'))
		{
			Schema::create('ventas_productos', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('venta_id')->unsigned();
				$table->bigInteger('producto_id')->unsigned();
				$table->foreign('venta_id')->references('id')->on('ventas');
				$table->foreign('producto_id')->references('id')->on('productos');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('ventas_productos');
	}
}
