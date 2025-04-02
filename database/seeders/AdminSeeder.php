<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Use DB Model User
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Default user fake test data
        // User::factory()->create();

        // Hard code name, email instead of using faker test data to insert their values
        // User::factory()->create(['name' => 'foo', 'email' => 'foo@example.com', 'is_admin' => true]);

        // Create admin user after running DB migration, overwrite is_admin migration field default boolean property
        User::factory()->create(['is_admin' => true]);
    }
}

/*

    We can seed data inside DatabaseSeeder.php file however it is better structure when writing seeders to use seeding files

    Seeders with factories is used to pre-populate test data, for testing of project initial values

    `php artisan make:seeder AdminSeeder'  // Generate seeder class inside database/seeders folder for admin user

    `php artisan db:seed`                  // Run DB seeder class test data

    // https://laraveldaily.com/lesson/laravel-beginners/generate-user-factories-seeds
    // https://medium.com/@mahedyhasan017/connect-laravel-with-mysql-database-d8baa29e2ea4

*/
