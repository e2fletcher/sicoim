<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('clientes'))
		{
			Schema::create('clientes', function(Blueprint $table){
				$table->engine = 'InnoBD';
				$table->increments('id');
				$table->string('ident')->unique();
				$table->string('nombre');
				$table->enum('ident_t', ['v', 'e', 'j', 'g'])->nullable();
				$table->string('direccion', 100)->nullable();
				$table->string('telefono', 20)->nullable();
				$table->string('email')->nullable();
				$table->timestamps();
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('clientes');
	}
}
