<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleHasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all permissions
        $permissions = Permission::pluck('id','id')->all();
        //get the admin role
        $adminRole = Role::where('name', 'admin')->first();
        // Sync all permissions to the admin role
        $adminRole->syncPermissions($permissions);
    }
}
