<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('ventas'))
		{
			Schema::create('ventas', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('cliente_id')->unsigned();
				$table->integer('user_id')->unsigned();
				$table->integer('sucursal_id')->unsigned();
				$table->timestamps();
				$table->foreign('cliente_id')->references('id')->on('clientes');
				$table->foreign('sucursal_id')->references('id')->on('sucursals');
				$table->foreign('user_id')->references('id')->on('users');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('ventas');
	}
}
