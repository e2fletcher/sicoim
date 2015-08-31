<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSucursalsTable extends Migration
{
	public function up()
	{
		if(!Schema::hasTable('sucursals'))
		{
			Schema::create('sucursals', function(Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->string('codigo')->unique();
				$table->string('nombre')->unique();
				$table->string('direccion');
				$table->string('tlf');
				$table->timestamps();
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('sucursals');
	}
}
