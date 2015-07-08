<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        DB::table('users')->delete();
        User::create([
                'email' => 'admin@gmail.com',
                'username' => 'Admin',
                'password' => bcrypt('123456'),
                'user_type' => '1',
                'dept_name' => 'ISD',
            ]
        );
	}

}
