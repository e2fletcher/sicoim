<?php

use Illuminate\Database\Seeder;
use App\Tipo;

class TiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{

		\DB::table('tipos')->delete();
                
                /*
                 * $s = new Tipo;
                 * $s->codigo = 'harin-001';
                 * $s->nombre = 'Harina de Maiz Amarillo';
                 * $s->generic_tipo = 'Harina';
                 * $s->origen = 'Casa';
                 * $s->precio = 9.43949;
                 * $s->presentacion = 'Bulto';
                 * $s->cantidad = 20;
                 * $s->unidad = 'Kilogramo';
                 * $s->save();
                 */
	}
}
