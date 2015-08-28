<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferenciasTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('transferencias'))
		{
			Schema::create('transferencias', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('sucursal_id')->unsigned();
				$table->integer('user_id')->unsigned();
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('sucursal_id')->references('id')->on('sucursals');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('transferencias');
	}
}
