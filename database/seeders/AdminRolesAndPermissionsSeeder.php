<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class AdminRolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            // إدارة المشرفين
            ['name' => 'manage-admins', 'guard_name' => 'admin', 'description' => 'إدارة المشرفين'],
            ['name' => 'create-admin', 'guard_name' => 'admin', 'description' => 'إضافة مشرف جديد'],
            ['name' => 'edit-admin', 'guard_name' => 'admin', 'description' => 'تعديل بيانات المشرف'],
            ['name' => 'delete-admin', 'guard_name' => 'admin', 'description' => 'حذف مشرف'],
            ['name' => 'view-admin', 'guard_name' => 'admin', 'description' => 'عرض بيانات المشرف'],
            
            // إدارة الأدوار والصلاحيات
            ['name' => 'manage-roles', 'guard_name' => 'admin', 'description' => 'إدارة الأدوار'],
            ['name' => 'manage-permissions', 'guard_name' => 'admin', 'description' => 'إدارة الصلاحيات'],
            
            // لوحة التحكم
            ['name' => 'view-dashboard', 'guard_name' => 'admin', 'description' => 'عرض لوحة التحكم'],
            
            // الحسابات العامة
            ['name' => 'manage-accounts', 'guard_name' => 'admin', 'description' => 'إدارة الحسابات العامة'],
            
            // التخزين
            ['name' => 'manage-inventory', 'guard_name' => 'admin', 'description' => 'إدارة المخزون'],
            
            // العملاء
            ['name' => 'manage-customers', 'guard_name' => 'admin', 'description' => 'إدارة العملاء'],
            
            // المشتريات
            ['name' => 'manage-purchases', 'guard_name' => 'admin', 'description' => 'إدارة المشتريات'],
            
            // المبيعات
            ['name' => 'manage-sales', 'guard_name' => 'admin', 'description' => 'إدارة المبيعات'],
            
            // التشغيل
            ['name' => 'manage-operations', 'guard_name' => 'admin', 'description' => 'إدارة التشغيل'],
            
            // الإعدادات
            ['name' => 'manage-settings', 'guard_name' => 'admin', 'description' => 'إدارة الإعدادات']
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],
                ['description' => $permission['description']]
            );
        }

        // Create roles and assign permissions
        $roles = [
            'super-admin' => 'مدير عام النظام',
            'admin' => 'مدير النظام',
            'moderator' => 'مشرف'
        ];

        foreach ($roles as $roleName => $description) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'admin'
            ]);

            if ($roleName === 'super-admin') {
                // Super admin gets all permissions
                $role->syncPermissions(Permission::all());
            } elseif ($roleName === 'admin') {
                // Admin gets all permissions except managing roles and permissions
                $role->syncPermissions(Permission::whereNotIn('name', ['manage-roles', 'manage-permissions'])->get());
            } else {
                // Moderator gets basic permissions
                $role->syncPermissions([
                    'view-dashboard',
                    'view-admin',
                    'manage-customers',
                    'manage-sales',
                    'manage-inventory'
                ]);
            }
        }
    }
}
