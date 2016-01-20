<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Sucursal;
use App\Tipo;
use App\Proveedor;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		\DB::table('sucursals')->delete();
		$s = new Sucursal;
		$s->nombre = 'Centro de Acopio Sabana de Mendoza';
		$s->tlf = '0271-6694323';
		$s->coordenadas = '9.43949,-70.78225';
		$s->direccion = 'Sabana de Mendoza, Urbanización Valmore Rodriguez Carrera #5 Local #4';
		$s->ident = '001';
		$s->save();

		\DB::table('tipos')->delete();
		$s = new Tipo;
		$s->codigo = 'harin-001';
		$s->nombre = 'Harina de Maiz Amarillo';
		$s->generic_tipo = 'Harina';
		$s->origen = 'Casa';
		$s->precio = 9.43949;
		$s->presentacion = 'Bulto';
		$s->cantidad = 20;
		$s->unidad = 'Kilogramo';
		$s->save();

		\DB::table('users')->delete();
		$admin = new User;
		$admin->email = 'e2fletcher@gmail.com';
		$admin->name = 'Ender Fletcher';
		$admin->password = \Hash::make('1234');
		$admin->type = 0;
		$admin->save();

		$coord = new User;
		$coord->email = 'coord@sicoime.com';
		$coord->name = 'coordinador';
		$coord->password = \Hash::make('1234');
		$coord->type = 1;
		$coord->sucursal_id = $s->id;
		$coord->save();
	}
}
