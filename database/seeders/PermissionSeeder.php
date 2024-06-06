<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define permissions for routes
        $permissions = [
            'users.index',
            'users.show',
            'users.create',
            'users.edit',
            'users.update',
            'users.store',
            'users.destroy',
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

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}
