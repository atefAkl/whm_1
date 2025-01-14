<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Management Permissions
        Permission::create(['name' => 'manage-admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'register-admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit-admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'view-admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'manage-settings', 'guard_name' => 'admin']);

        // Roles Management
        Permission::create(['name' => 'manage-roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'create-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'view-roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'assign-roles', 'guard_name' => 'admin']);

        // Permissions Management
        Permission::create(['name' => 'manage-permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'create-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'edit-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'view-permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'assign-permissions', 'guard_name' => 'admin']);

        // Settings
        Permission::create(['name' => 'edit-settings', 'guard_name' => 'admin']);
        Permission::create(['name' => 'view-settings', 'guard_name' => 'admin']);

        // Logs
        Permission::create(['name' => 'view-logs', 'guard_name' => 'admin']);
        Permission::create(['name' => 'manage-logs', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-logs', 'guard_name' => 'admin']);

        // Dashboard
        Permission::create(['name' => 'view-dashboard', 'guard_name' => 'admin']);
        Permission::create(['name' => 'view-statistics', 'guard_name' => 'admin']);

        // Profile
        Permission::create(['name' => 'edit-profile', 'guard_name' => 'admin']);
        Permission::create(['name' => 'change-password', 'guard_name' => 'admin']);

        // System
        Permission::create(['name' => 'manage-system', 'guard_name' => 'admin']);
        Permission::create(['name' => 'view-system-info', 'guard_name' => 'admin']);
        Permission::create(['name' => 'manage-backups', 'guard_name' => 'admin']);
        Permission::create(['name' => 'create-backup', 'guard_name' => 'admin']);
        Permission::create(['name' => 'restore-backup', 'guard_name' => 'admin']);
        Permission::create(['name' => 'delete-backup', 'guard_name' => 'admin']);

        // Create Roles
        $superAdmin = Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);
        $admin = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $moderator = Role::create(['name' => 'moderator', 'guard_name' => 'admin']);

        // Give all permissions to super-admin
        $superAdmin->givePermissionTo(Permission::where('guard_name', 'admin')->get());

        // Give specific permissions to admin
        $admin->givePermissionTo([
            'manage-admins',
            'edit-admin',
            'manage-settings'
        ]);

        // Give limited permissions to moderator
        $moderator->givePermissionTo([
            'edit-admin'
        ]);
    }
}
