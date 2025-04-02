<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add is_admin boolean field with default false value to users table
            $table->boolean('is_admin')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove is_admin boolean field from users table
            Schema::dropColumns('users','is_admin');
        });
    }
};

/*

    `php artisan make:migration "add is admin to users table"`  // Add is_admin boolean column field to users table

    `php artisan db:seed`                                       // Run DB seeder class test data

    // https://laraveldaily.com/lesson/laravel-beginners/generate-user-factories-seeds
*/
