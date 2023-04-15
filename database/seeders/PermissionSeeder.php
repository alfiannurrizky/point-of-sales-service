<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // permission for categories
        Permission::create(['name' => 'categories.index']);
        Permission::create(['name' => 'categories.create']);
        Permission::create(['name' => 'categories.edit']);
        Permission::create(['name' => 'categories.delete']);

        // permission for products
        Permission::create(['name' => 'products.index']);
        Permission::create(['name' => 'products.create']);
        Permission::create(['name' => 'products.edit']);
        Permission::create(['name' => 'products.delete']);

        // permission for payments
        Permission::create(['name' => 'payments.index']);
        Permission::create(['name' => 'payments.create']);
        Permission::create(['name' => 'payments.edit']);
        Permission::create(['name' => 'payments.delete']);

        // permission for orders
        Permission::create(['name' => 'orders.index']);
        Permission::create(['name' => 'orders.create']);
    
    }
}
