<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $permissions = Config::get('permission_constant.permissions');
           $roles =Role::all();
           foreach ($permissions as $permission){
           $permissionName = Permission::updateOrCreate(['name' =>$permission['name']]);
                foreach($roles as $role){
                  if(in_array($role->name,$permission['role_name'])){
                    $role->givePermissionTo($permissionName);
                  }
                }
            }

    }
}
