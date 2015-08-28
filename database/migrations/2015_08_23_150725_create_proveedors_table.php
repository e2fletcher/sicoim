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
				$table->string('nombre', 100)->unique();
				$table->string('ident')->unique();
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
		Schema::dropIfExists('proveedors');
	}
}
