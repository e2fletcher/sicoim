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
				$table->string('ident')->unique();
				$table->string('nombre');
				$table->string('direccion');
				$table->string('photo');
				$table->string('tlf');
				$table->string('coordenadas');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('sucursals');
	}
}
