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
        //
        $user=[
	     	['name'=>"Admin",
	     	 'email'=>"bharti08@gmail.com",
	     	 'password'=>bcrypt("admin123")
	     	]
     	];

        User::insert($user);

    }
}
