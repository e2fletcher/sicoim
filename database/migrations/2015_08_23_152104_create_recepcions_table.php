<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecepcionsTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('recepcions'))
		{
			Schema::create('recepcions', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->integer('sucursal_id')->unsigned();
				$table->integer('proveedor_id')->unsigned();
				$table->timestamps();
				$table->foreign('sucursal_id')->references('id')->on('sucursals');
				$table->foreign('proveedor_id')->references('id')->on('proveedors');
				$table->foreign('user_id')->references('id')->on('users');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('recepcions');
	}
}
