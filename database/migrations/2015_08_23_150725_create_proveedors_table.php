<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorsTable extends Migration
{
	public function up()
	{
		if(!Schema::hasTable('proveedors'))
		{
			Schema::create('proveedors', function(Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->string('nombre')->unique();
				$table->string('ident')->unique();
				$table->string('direccion')->nullable();
				$table->string('tlf')->nullable();
				$table->string('email')->nullable();
				$table->timestamps();
			});
		}
	}

	public function down()
	{
		Schema::dropIfExists('proveedors');
	}
}
