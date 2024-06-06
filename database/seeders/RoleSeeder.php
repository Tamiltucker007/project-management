<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define roles
        Role::findOrCreate('admin', 'web');
        Role::findOrCreate('project-manager', 'web');
        Role::findOrCreate('team-member', 'web');
    }
}