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
        // Sync all permissions to admin role
        $adminRole->syncPermissions($permissions);

        // Define specific permissions for  project-manager role
        $projectManagerPermissions = [
            'projects.index',
            'projects.show',
            'projects.create',
            'projects.edit',
            'projects.update',
            'projects.store',
            'projects.destroy',
            'tasks.index',
            'tasks.show',
            'tasks.create',
            'tasks.edit',
            'tasks.update',
            'tasks.store',
            'tasks.destroy',
        ];

        if ($projectManagerPermissions) {
            $mangerPermissions = Permission::whereIn('name', $projectManagerPermissions)->pluck('id')->all();
            // Retrieve the project-manager role
            $projectManagerRole = Role::where('name', 'project-manager')->first();
            // Sync specific permissions to the project-manager role
            $projectManagerRole->syncPermissions($mangerPermissions);
        }

        // Here we sync team members permissions
        $teamMemberPermissions = [
            'projects.index',
            'projects.show',
            'tasks.index',
            'tasks.show',
        ];

        if ($teamMemberPermissions) {
            $memberPermissions = Permission::whereIn('name', $teamMemberPermissions)->pluck('id')->all();
            $teamMemberRole = Role::where('name', 'team-member')->first();
            $teamMemberRole->syncPermissions($memberPermissions);
        }
    }
}
