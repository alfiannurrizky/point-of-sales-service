<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $role1 = Role::find(1);
       $permission = Permission::all();

       $role1->givePermissionTo($permission);


       $role2 = Role::find(2);

       $permission1 = Permission::find(13); 
       $permission2 = Permission::find(14); 

       $role2->givePermissionTo([$permission1, $permission2]);
       
        // $user1 = User::find(1);
        // $role1 = Role::find(1);

        // $user1->assignRole($role1);

        // $user2 = User::find(2);
        // $role2 = Role::find(2);

        // $user2->assignRole($role2);

    }
}
