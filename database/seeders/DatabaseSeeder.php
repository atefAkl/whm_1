<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminPermissionsSeeder;
use Database\Seeders\AdminRoleAssignmentSeeder;

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
            AdminPermissionsSeeder::class,
            AdminRoleAssignmentSeeder::class,
        ]);
    }
}
