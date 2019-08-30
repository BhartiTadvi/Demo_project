<?php

use Illuminate\Database\Seeder;
use App\usersmodel;


class Usersseeder extends Seeder
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
	     	['firstname'=>"Admin",
	     	 'lastname'=>"admin",
	     	 'email'=>"bharti08@gmail.com",
	     	 'password'=>bcrypt("admin123")
	     	]
     	];

        usersmodel::insert($user);


    }
}
