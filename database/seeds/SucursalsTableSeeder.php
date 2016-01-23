<?php

use Illuminate\Database\Seeder;
use App\Sucursal;

class SucursalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{

		\DB::table('sucursals')->delete();
                
                /** 
                 * $s = new Sucursal;
		 * $s->nombre = 'NOMBRE';
		 * $s->tlf = 'NUMERO TLF';
		 * $s->coordenadas = '0.000000,0.00000';
	  	 * $s->direccion = 'DIRECCION';
		 * $s->ident = 'CODIGO';
                 * $s->save();
                 *
                 **/

	}
}
