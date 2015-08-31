<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
	public function up()
	{
		if(!Schema::hasTable('roles'))
		{
			Schema::create('roles', function(Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->string('name')->unique();
				$table->timestamps();
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('roles');
	}
}
