<?php

use Illuminate\Database\Seeder;
use App\User;

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
		$admin = new User;
		$admin->email = 'admin@admin.com';
		$admin->name = 'administrador';
		$admin->password = \Hash::make('admin');
		$admin->save();
	}
}
