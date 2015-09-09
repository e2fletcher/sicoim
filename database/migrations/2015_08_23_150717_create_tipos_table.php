<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposTable extends Migration
{
	public function up()
	{
		if(!Schema::hasTable('tipos'))
		{
			Schema::create('tipos', function(Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->string('codigo')->unique();
				$table->string('nombre')->unique();
				$table->enum('origen', ['casa', 'regional']);
				$table->enum('unidad', ['kilos', 'litros', 'unidad', 'caja', 'paquete']);
				$table->float('cantidad');
				$table->timestamps();
			});
		}
	}

	public function down()
	{
		// Drop Sucursal
		Schema::dropIfExists('tipos');
	}
}
