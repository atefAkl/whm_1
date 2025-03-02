<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminPermissionsSeeder;
use Database\Seeders\AdminRoleAssignmentSeeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,              // First create the admin user
            AdminPermissionsSeeder::class,   // Then create roles and permissions
            AdminRoleAssignmentSeeder::class // Finally assign roles to admin
        ]);
    }
}
