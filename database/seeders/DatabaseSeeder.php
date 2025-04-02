<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* Test User was already inserted into users table using: php artisan db:seed OR unique email error thrown
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        // Call admin seeder class to add admin user test data
        $this->call(AdminSeeder::class);
    }
}

/*

    We can seed data inside DatabaseSeeder.php file however it is better structure when writing seeders to use seeding files

    `php artisan make:seeder AdminSeeder'   // Generate seeder class inside database/seeders folder for admin user

    // For different TaskSeeder class fake test data
    //\App\Models\Task::factory(20)->create();
*/
