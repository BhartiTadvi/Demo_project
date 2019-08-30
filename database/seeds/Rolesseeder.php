<?php

use Illuminate\Database\Seeder;
use App\Rolesmodel;

class Rolesseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

     $role=[
	     	['role_name'=>"superadmin"],
	     	['role_name'=>"admin"],
	     	['role_name'=>"inventory manager"],
	     	['role_name'=>"order manager"],
	     	['role_name'=>"customer"]
     	];

        Rolesmodel::insert($role);
    }
}
