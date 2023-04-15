<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $adminCreate = User::create([
        //     'name'      => 'admin',
        //     'email'     => 'admin@gmail.com',
        //     'password'  => bcrypt('password')
        // ]);

        $kasirCreate = User::create([
            'name'      => 'kasir',
            'email'     => 'kasir@gmail.com',
            'password'  => bcrypt('password')
        ]);

    }
}
