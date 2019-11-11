<?php

use Illuminate\Database\Seeder;
use App\Rolesmodel;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role=[
	     	['name'=>"superadmin"],
	     	['name'=>"admin"],
	     	['name'=>"inventory manager"],
	     	['name'=>"order manager"],
	     	['name'=>"customer"]
     	];

        Rolesmodel::insert($role);
    }
}
