<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallestransferenciasTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('detallestransferencias'))
		{
			Schema::create('detallestransferencias', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('transferencia_id')->unsigned();
				$table->integer('producto_id')->unsigned();
				$table->integer('cantidad');
				$table->float('precio');
				$table->foreign('transferencia_id')->references('id')->on('transferencias');
				$table->foreign('producto_id')->references('id')->on('productos');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('detallestransferencias');
	}
}
