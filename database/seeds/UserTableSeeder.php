<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\DB::table('users')->delete();
		\DB::table('users')->insert(array(
			'name' => 'admin',
			'email' => 'admin@admin.com',
			'ident' => '0000000000',
			'ident_t' => 'v',
			'sucursal_id' => \DB::table('sucursals')->first()->id,
			'telefono' => '0000000000',
			'password' => \Hash::make('admin'),
			'created_at' => new DateTime('NOW'),
			'updated_at' => new DateTime('NOW')
		));
    }
}
