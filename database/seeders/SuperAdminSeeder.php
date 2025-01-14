<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'register-admins',
            'manage-roles',
            'manage-permissions',
            'view-logs',
            'manage-settings',
            'view-admins',
            'edit-admins',
            'delete-admins',
            'edit-profile',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // Create Super Admin role
        $role = Role::firstOrCreate(
            ['name' => 'Super Admin', 'guard_name' => 'admin']
        );

        // Assign all permissions to Super Admin role
        $role->syncPermissions($permissions);

        // Create Super Admin user if it doesn't exist
        $superAdmin = Admin::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'System Admin ' . now()->format('YmdHis'),
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'created_by' => 0, // System created
                'updated_by' => 0,
            ]
        );

        // Assign Super Admin role to the user
        $superAdmin->assignRole($role);
    }
}
