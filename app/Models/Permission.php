<?php

namespace App\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $table = 'permissions';

    public static function groups()
    {
        return [
            'admins'                => 'Admins',
            'profile'               => 'Profile',
            'general_accounts'      => 'General Accounts',
            'inventory'             => 'Inventory',
            'customers'             => 'Customers',
            'purchases'             => 'Purchases',
            'sales'                 => 'Sales',
            'operations'            => 'Operations',
            'settings'              => 'Settings',
            'roles'                 => 'Roles',
            'permissions'           => 'Permissions',
        ];
    }

    public static function guards()
    {
        return [
            'user'      => 'User',
            'admin'     => 'Admin',
            'worker'    => 'Worker',
            'employee'  => 'Employee',
            'client'    => 'Client'
        ];
    }

    public function relatedPermissions()
    {
        return $this->hasMany(Permission::class, 'group_name', 'name');
    }
}
