<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Sucursal;

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
		$s->nombre = 'Mercal Tipo 1 Sabana de Mendoza';
		$s->tlf = '0271-43526222';
		$s->coordenadas = '9.43949,-70.78225';
		$s->direccion = 'Sabana de Mendoza Urb. Inavi Primer Estacionamiento Local 1';
		$s->ident = '001';
		$s->save();

		\DB::table('users')->delete();
		$admin = new User;
		$admin->email = 'admin@sicoime.com';
		$admin->name = 'administrador';
		$admin->password = \Hash::make('admin');
		$admin->type = 0;
		$admin->save();
		$admin->sucursals()->sync([$s->id]);

		$coord = new User;
		$coord->email = 'coord@sicoime.com';
		$coord->name = 'coordinador';
		$coord->password = \Hash::make('1234');
		$coord->type = 1;
		$coord->save();
		$coord->sucursals()->sync([$s->id]);
	}
}
