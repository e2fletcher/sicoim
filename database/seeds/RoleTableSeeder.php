<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		\DB::table('roles')->delete();

		// Rol que permite editar tipos de productos
		\DB::table('roles')->insert(array(
			'name' => 'edit_tipos',
			'created_at' => new DateTime('NOW'),
			'updated_at' => new DateTime('NOW')
		));
	}
}
