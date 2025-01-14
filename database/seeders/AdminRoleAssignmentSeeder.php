<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminRoleAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // تأكد من وجود المديرين
        $superAdmin = Admin::findOrFail(1); // المدير الأول
        $admin = Admin::findOrFail(2);      // المدير الثاني

        // تأكد من وجود الأدوار
        $superAdminRole = Role::where('name', 'super-admin')
            ->where('guard_name', 'admin')
            ->firstOrFail();
            
        $adminRole = Role::where('name', 'admin')
            ->where('guard_name', 'admin')
            ->firstOrFail();

        // إزالة أي أدوار سابقة (للتأكد من عدم التكرار)
        $superAdmin->syncRoles([]); 
        $admin->syncRoles([]);

        // تعيين الأدوار
        $superAdmin->assignRole($superAdminRole);
        $admin->assignRole($adminRole);

        // إعطاء صلاحية manage-settings للمدير الثاني
        $admin->givePermissionTo('manage-settings');

        $this->command->info('تم تعيين الأدوار والصلاحيات للمديرين بنجاح');
    }
}
