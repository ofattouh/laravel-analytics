<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Use DB Model Permission
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create user permissions
        Permission::create(['name' => 'db.rows.select', 'description' => 'Has the capability to retrieve database records']);
        Permission::create(['name' => 'db.rows.create', 'description' => 'Has the capability to save database records']);
        Permission::create(['name' => 'db.rows.update', 'description' => 'Has the capability to update database records']);
        Permission::create(['name' => 'db.rows.delete', 'description' => 'Has the capability to delete database records']);
    }
}
