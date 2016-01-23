<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
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
		$admin->email = 'admin@sicoime.com';
		$admin->name = 'Admin Sicoime System';
		$admin->password = \Hash::make('admin');
		$admin->type = 0;
		$admin->save();
	}
}
