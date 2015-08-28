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
				$table->bigIncrements('id');
				$table->integer('tipo_id')->unsigned();
				$table->integer('sucursal_id')->unsigned();
				$table->integer('proveedor_id')->unsigned();
				$table->date('vencimiento');
				$table->enum('status', ['existente', 'vendido', 'perdido', 'dañado']);
				$table->float('precio');
				$table->foreign('tipo_id')->references('id')->on('tipos');
				$table->foreign('sucursal_id')->references('id')->on('sucursals');
				$table->foreign('proveedor_id')->references('id')->on('proveedors');
				$table->timestamps();
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('productos');
	}
}
