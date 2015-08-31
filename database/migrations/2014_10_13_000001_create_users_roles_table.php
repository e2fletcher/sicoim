<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRolesTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('users_roles'))
		{
			Schema::create('users_roles', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('user_id')->unsigned();
				$table->integer('role_id')->unsigned();
				$table->timestamps();
				$table->foreign('user_id')->references('id')->on('users');
				$table->foreign('role_id')->references('id')->on('roles');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('users_roles');
	}
}
