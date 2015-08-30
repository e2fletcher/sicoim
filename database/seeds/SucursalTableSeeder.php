<?php

use Illuminate\Database\Seeder;

class SucursalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
		\DB::table('sucursals')->delete();

		\DB::table('sucursals')->insert(array(
			'codigo'	=> '001',
			'nombre'	=> 'mercalito las cejitas',
			'lugar'		=> 'las cejitas',
			'telefono'	=> '0416-6989917',
			'created_at' => new DateTime('NOW'),
			'updated_at' => new DateTime('NOW')
		));
    }
}
