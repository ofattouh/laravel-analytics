<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* Test User was already inserted into users table using: `php artisan db:seed` otherwise throws unique email error
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */

        // Call admin seeder class to add admin user test data
        // $this->call(AdminSeeder::class);

        // Call Post seeder class to add table:posts seeder test data
        // $this->call([PostSeeder::class]);

        // Create 10 test entries inside table:users of Model:User using this factory method
        // User::factory(10)->create();

        /* Call these seeder classes in this order to add user permissions/roles to corresponding tables
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
        */

        // Create 10,20 test entries inside tables:Category,Product using their Models and factory methods
        Category::factory(10)->create();
        Product::factory(20)->create();
    }
}

/*

    We can seed data inside DatabaseSeeder.php main file however it is better structure when writing seeders
    to use different seeding files

    `php artisan make:seeder AdminSeeder'   // Generate seeder class inside database/seeders folder for admin test user

    // Create test data for TaskSeeder class
    //\App\Models\Task::factory(20)->create();
*/
