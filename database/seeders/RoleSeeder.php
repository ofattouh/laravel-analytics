<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Use DB Model Role
use App\Models\Role;

// Use DB Model Permission
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create subscriber role which can ONLY select rows
        $subscriber = Role::create(['name' => 'Subscriber']);
        $subscriber->permissions()->attach(
            Permission::where('name', 'db.rows.select')->pluck('id')
        );

        // Create editor role which has all DB permissions except delete rows
        $editor = Role::create(['name' => 'Editor']);
        $editor->permissions()->attach(
            Permission::where('name', '!=', 'db.rows.delete')->pluck('id')
        );

        // Create admin role which can do ALL DB CRUD (ALL Permissions)
        $admin = Role::create(['name' => 'Administrator']);
        $admin->permissions()->attach(Permission::pluck('id'));
    }
}
