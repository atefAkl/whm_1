<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRoleAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        // Get the super admin user
        $superAdmin = Admin::where('email', 'admin@admin.com')->firstOrFail();

        // Get the super-admin role
        $superAdminRole = Role::where('name', 'super-admin')
            ->where('guard_name', 'admin')
            ->firstOrFail();

        // Assign the role
        $superAdmin->syncRoles([$superAdminRole]);

        // Assign all permissions
        $permissions = Permission::all();
        $superAdmin->syncPermissions($permissions);
    }
}
