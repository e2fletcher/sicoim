<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesrecepcionsTable extends Migration
{
	public function up()
	{
		if (!Schema::hasTable('detallesrecepcions'))
		{
			Schema::create('detallesrecepcions', function (Blueprint $table){
				$table->engine = 'InnoDB';
				$table->increments('id');
				$table->integer('recepcion_id')->unsigned();
				$table->integer('tipo_id')->unsigned();
				$table->integer('cantidad');
				$table->float('precio');
				$table->string('caducidad');
				$table->foreign('recepcion_id')->references('id')->on('recepcions');
				$table->foreign('tipo_id')->references('id')->on('tipos');
			});
		}
	}
	
	public function down()
	{
		Schema::dropIfExists('detallesrecepcions');
	}
}
