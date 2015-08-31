<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersSucursalsTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('users_sucursals'))
		{
			Schema::create('users_sucursals', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->integer('sucursal_id')->unsigned();
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('sucursal_id')->references('id')->on('sucursals');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('users_sucursals');
	}
}
