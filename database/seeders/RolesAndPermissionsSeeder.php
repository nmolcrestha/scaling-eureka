<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view orders',
            'update order status',
            'delete orders',
            'view users',
            'create users',
            'edit users',
            'delete users',
            'ban users',
            'view roles',
            'manage roles',
            'view dashboard',
            'view analytics',
            'manage settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'delete products',
            'view orders',
            'update order status',
            'delete orders',
            'view users',
            'create users',
            'edit users',
            'ban users',
            'view dashboard',
            'view analytics',
            'manage settings',
        ]);


        $manager = Role::firstOrCreate(['name' => 'manager']);
        $manager->syncPermissions([
            'view products',
            'create products',
            'edit products',
            'view orders',
            'update order status',
            'view users',
            'view dashboard',
            'view analytics',
        ]);


        $staff = Role::firstOrCreate(['name' => 'staff']);
        $staff->syncPermissions([
            'view products',
            'create products',
            'view orders',
            'update order status',
            'view dashboard',
        ]);


        $customer = Role::firstOrCreate(['name' => 'customer']);
        $customer->syncPermissions([]);
    }
}
