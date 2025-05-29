<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Use DB Model User
use App\Models\User;

// Use DB Model Role
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create entries into table:`user` with different users roles

        // Subscriber role can ONLY select rows

        $subscriber = User::factory()->create(['email' => 'subscriberuser@example.com']);
        $subscriber->roles()->attach(Role::where('name', 'Subscriber')->value('id'));

        $subscriber = User::factory()->create(['email' => 'subscriberuser2@example.com']);
        $subscriber->roles()->attach(Role::where('name', 'Subscriber')->value('id'));

        $subscriber = User::factory()->create(['email' => 'subscriberuser3@example.com']);
        $subscriber->roles()->attach(Role::where('name', 'Subscriber')->value('id'));

        // Editor role can do ALL DB CRUD except for delete rows

        $editor = User::factory()->create(['email' => 'editoruser@example.com']);
        $editor->roles()->attach(Role::where('name', 'Editor')->value('id'));

        $editor = User::factory()->create(['email' => 'editoruser2@example.com']);
        $editor->roles()->attach(Role::where('name', 'Editor')->value('id'));

        // Administrator role can do ALL DB CRUD (ALL Permissions)

        $admin = User::factory()->create(['name' => 'webmaster', 'email' => 'webmaster@example.com']);
        $admin->roles()->attach(Role::where('name', 'Administrator')->value('id'));

        $admin = User::factory()->create(['name' => 'Omar Mohamed', 'email' => 'omohamed@pshsa.ca']);
        $admin->roles()->attach(Role::where('name', 'Administrator')->value('id'));

    }
}

/*

    $allUsers = User::all();

    // Find user by id (users table with id=3)
    $admin2 = User::find(3);

    // Get all users (users table ids except logged-in user id)
    $otherUsers  = User::all()->except(Auth::id());
    $otherUsers2 = User::where('id', '!=', auth()->id())->get();

*/
