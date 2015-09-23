<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesventasTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('detallesventas'))
		{
			Schema::create('detallesventas', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('venta_id')->unsigned();
				$table->integer('tipo_id')->unsigned();
				$table->integer('cantidad');
				$table->float('precio');
				$table->foreign('venta_id')->references('id')->on('ventas');
				$table->foreign('tipo_id')->references('id')->on('tipos');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('detallesventas');
	}
}
