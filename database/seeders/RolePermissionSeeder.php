<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create role
        $role = Role::create([
            'name' => 'Admin',
            'code' => 'admin',
        ]);

        //permission list as array
        $permissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'profile-index',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'cmscategory-list',
            'cmscategory-create',
            'cmscategory-edit',
            'cmscategory-delete',

            'cmspage-list',
            'cmspage-create',
            'cmspage-edit',
            'cmspage-delete',

            'currency-list',
            'currency-create',
            'currency-edit',
            'currency-delete',

            'file-manager',
            'websetting-edit',
            'user-activity',
            'log-view',
        ];

        //create and assign permission 
        for($i=0; $i<count($permissions); $i++)
        {
            $permission = Permission::create(['name' => $permissions[$i]]);

            $role->givePermissionTo($permission);
            $permission->assignRole($role);
        }
       
    }
}
